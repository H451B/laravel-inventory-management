<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProductAttributeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:product-category-list|product-category-create|product-category-edit|product-category-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:product-category-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-category-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-category-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:product-type-list|product-type-create|product-type-edit|product-type-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:product-type-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-type-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-type-delete'], ['only' => ['destroy']]);
    }

    public function index(){
        $productCategories = ProductCategory::paginate(7);
        $productTypes = ProductType::paginate(7);
        $categories = ProductCategory::all();
        return view('product.attribute.product-attribute-index', compact('productTypes','productCategories','categories'));
    }

    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            ProductCategory::create($request->all());
            return redirect()->route('product.attributes.index')->with('success', 'Product Category created successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Creating Product Category: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the Product Category.');
        }
    }

    public function storeType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:product_types,name',
            'product_category_id' => 'required|exists:product_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            ProductType::create($request->all());
            return redirect()->route('product.attributes.index')->with('success', 'Product Type created successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Creating Product Type: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the Product Type.');
        }
    }

    public function updateCategory(Request $request, ProductCategory $productCategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $productCategory->update($request->all());
            return redirect()->route('product.attributes.index')->with('success', 'Product Category updated successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Updating Product Category: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the Product Category.');
        }
    }

    public function updateType(Request $request, ProductType $productType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'product_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $productType->update($request->all());
            return redirect()->route('product.attributes.index')->with('success', 'Product Type updated successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Updating Product Type: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the Product Type.');
        }
    }

    public function destroyCategory(ProductCategory $productCategory)
    {
        try {
            $productCategory->delete();
            return redirect()->route('product.attributes.index')->with('success', 'Product Category deleted successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Deleting Product Category: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while deleting the Product Category.');
        }
    }

    public function destroyType(ProductType $productType)
    {
        try {
            $productType->delete();
            return redirect()->route('product.attributes.index')->with('success', 'Product Type deleted successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Deleting Product Type: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while deleting the Product Type.');
        }
    }
}
