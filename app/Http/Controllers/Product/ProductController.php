<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Traits\FileUploadTrait;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:product-list|product-create|product-edit|product-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $products = Product::all();
        return view('product.product-index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('product.product-show', compact('product'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $types = ProductType::all();
        // $suppliers = Supplier::all();
        return view('product.product-create', compact('categories', 'types'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $types = ProductType::all();
        return view('product.product-edit', compact('categories', 'types','product'));
    }

    use FileUploadTrait;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string',
            'description' => 'nullable|string',
            'unit_purchase_price' => 'nullable|numeric|min:0',
            'unit_selling_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'qty' => 'nullable|integer|min:0',
            'expiry_date' => 'nullable|date',
            'product_category_id' => 'required',
            'product_type_id' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming each image should be less than 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = strtolower(str_replace(' ', '-', $request->name));
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->unit_purchase_price = $request->unit_purchase_price;
            $product->unit_selling_price = $request->unit_selling_price;
            $product->discount_percentage = $request->discount_percentage;
            $product->status = 0;
            $product->qty = 0;
            $product->expiry_date = $request->expiry_date;
            $product->product_category_id = $request->product_category_id;
            $product->product_type_id = $request->product_type_id;
            $product->save();

            // Handle product images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $this->uploadFile($image, 'product_images', 400, 400);
                    $product->images()->create(['image_path' => $imagePath]);
                }
            }

            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Throwable $th) {
            Log::error('Error Creating Product: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the Product.');
        }
    }

    // use FileUploadTrait;
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string',
            'description' => 'nullable|string',
            'unit_purchase_price' => 'nullable|numeric|min:0',
            'unit_selling_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'qty' => 'nullable|integer|min:0',
            'expiry_date' => 'nullable|date',
            'product_category_id' => 'required',
            'product_type_id' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming each image should be less than 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $product->name = $request->name;
            $product->slug = strtolower(str_replace(' ', '-', $request->name));
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->unit_purchase_price = $request->unit_purchase_price;
            $product->unit_selling_price = $request->unit_selling_price;
            $product->discount_percentage = $request->discount_percentage;
            $product->qty = $request->qty;
            $product->expiry_date = $request->expiry_date;
            $product->product_category_id = $request->product_category_id;
            $product->product_type_id = $request->product_type_id;
            $product->save();

            // Handle product images
            if ($request->hasFile('images')) {
                // Delete existing images
                $product->images()->delete();
                // Upload new images
                foreach ($request->file('images') as $image) {
                    $imagePath = $this->uploadFile($image, 'product_images', 400, 400);
                    $product->images()->create(['image_path' => $imagePath]);
                }
            }

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Updating Product: ' . $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the Product.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->images()->delete(); // Delete associated images
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Throwable $th) {
            Log::channel('crud_error')->error('Error Deleting Product: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the Product.');
        }
    }
}
