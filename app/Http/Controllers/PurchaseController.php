<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:purchase-list|purchase-create|purchase-edit|purchase-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:purchase-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:purchase-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:purchase-delete'], ['only' => ['destroy']]);
    }

    public function index(){
        $purchases = Purchase::paginate(7);
        return view('purchase.purchase-index',compact('purchases'));
    }

    public function create(){
        $categories = ProductCategory::all();
        $types = ProductType::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchase.purchase-create',compact('categories','types','suppliers','products'));
    }

    public function store(Request $request){
        dd($request);
    }
}
