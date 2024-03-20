<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('autz.role-index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::select('id', 'name')->get();
        $groupedPermissions = collect($permissions)->groupBy(function ($permission) {
            return explode('-', $permission->name)[0];
        });
        return view('autz.role-create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $role = Role::create(['name' => $request->name]);

            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);

            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            Log::channel('crud_error')->error('Error Creating Role: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error','An error occured');
        }
    }

    public function edit(Role $role)
    {
        if ($role->name == 'Super Admin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE EDITED');
        }

        $permissions = Permission::select('id', 'name')->get();
        $groupedPermissions = collect($permissions)->groupBy(function ($permission) {
            return explode('-', $permission->name)[0];
        });

        $rolePermissions = DB::table("role_has_permissions")->where("role_id", $role->id)
            ->pluck('permission_id')
            ->all();

        return view('autz.role-edit', compact('rolePermissions', 'groupedPermissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'permissions' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $input = $request->only('name');
            $role->update($input);
            $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
            $role->syncPermissions($permissions);

            return redirect()->route('roles.index')->with('success','Role Updated');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Updating Role: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error','An error occured');
        }
    }

    public function destroy(Role $role)
    {
        $user = Auth::user();
        if ($role->name == 'Super Admin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
        }
        if ($user->hasRole($role->name)) {
            abort(403, 'CAN NOT DELETE SELF ASSIGNED ROLE');
        }
        $role->delete();
        return redirect()->back()
            ->withSuccess('Role is deleted successfully.');
    }
}
