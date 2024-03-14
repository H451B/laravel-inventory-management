<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User as AuthUser;
use Spatie\Permission\Models\Role;
use App\Traits\FileUploadTrait;

class UserController extends Controller
{
    use FileUploadTrait;

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:user-list|user-create|user-edit|user-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:user:destroy'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::all();
        return view('employee.user-index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('employee.user-create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'nid_number' => ['nullable', 'string', 'max:255', 'unique:users'],
            'nid_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,PNG,JPEG', 'max:2048'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,PNG,JPEG', 'max:2048'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'nid_number' => $request->nid_number,
                'nid_picture' => $request->hasFile('nid_picture') ? $this->uploadFile($request->file('nid_picture'), 'app/public/user_nid_photo', 300, 300) : null,
                'photo' => $request->hasFile('photo') ? $this->uploadFile($request->file('photo'), 'app/public/user_photo', 300, 300) : null,
                'phone' => $request->phone,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password),

            ]);

            if ($request->has('roles')) {
                $user->roles()->attach($request->roles);
            }

            return redirect()->route('users.index')->with('success', 'User Created');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Creating User: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occured');
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('employee.user-edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'nid_number' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nid_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,PNG,JPEG', 'max:2048'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,PNG,JPEG', 'max:2048'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $userData = [
                'name' => $request->name,
                'nid_number' => $request->nid_number,
                'phone' => $request->phone,
                'email' => strtolower($request->email),
            ];

            if ($request->has('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            // Update user data
            $user->update($userData);

            // Handle file uploads
            if ($request->hasFile('nid_picture')) {
                $newNidPicture = $this->uploadFile($request->file('nid_picture'), 'app/public/user_nid_photo', 300, 300);
                if ($newNidPicture) {
                    if ($user->nid_picture) {
                        $this->deleteFile('user_nid_photo/' . $user->nid_picture);
                    }
                    $user->nid_picture = $newNidPicture;
                }
            }

            if ($request->hasFile('photo')) {
                $newPhoto = $this->uploadFile($request->file('photo'), 'app/public/user_photo', 300, 300);
                if ($newPhoto) {
                    if ($user->photo) {
                        $this->deleteFile('user_photo/' . $user->photo);
                    }
                    $user->photo = $newPhoto;
                }
            }

            $user->save();

            // Sync user roles
            if ($request->has('roles')) {
                $user->roles()->sync($request->roles);
            }

            return redirect()->route('users.index')->with('success', 'User Updated');
        } catch (\Illuminate\Validation\ValidationException | \Illuminate\Database\Eloquent\ModelNotFoundException | \Exception $e) {
            Log::channel('crud_error')->error('Error Updating User: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating user');
        }
    }

    public function destroy(User $user)
    {
        try {
            if ($user->nid_picture) {
                $this->deleteFile('user_nid_photo/' . $user->nid_picture);
            }

            if ($user->photo) {
                $this->deleteFile('user_photo/' . $user->photo);
            }
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Deleting User: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while deleting the user.');
        }
    }

    public function show(User $user){
        return view('employee.user-show',compact('user'));
    }
}
