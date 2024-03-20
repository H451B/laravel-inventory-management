<?php

namespace App\Http\Controllers;

use App\Models\Purchase\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:supplier-list|supplier-create|supplier-edit|supplier-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:supplier-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:supplier-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:supplier-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.supplier-index', compact('suppliers'));
    }

    public function create(){
        return view('supplier.supplier-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone1' => ['required', 'string', 'max:255'],
            'phone2' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers'],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            Supplier::create($request->all());

            return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Creating Supplier: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the supplier.');
        }
    }

    // Update the specified supplier in storage.
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone1' => ['required', 'string', 'max:255'],
            'phone2' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers,email,' . $supplier->id],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $supplier->update($request->all());

            return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Updating Supplier: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the supplier.');
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Deleting Supplier: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while deleting the supplier.');
        }
    }
}
