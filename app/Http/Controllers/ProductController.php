<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Companies;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->product = new Product();
    }

    public function showListCreate() {
        $model = new Product();
        $products = $model->getList();
        $company_lists = Companies::all();
        return view('create', ['products' => $products, 'company_lists' => $company_lists]);
    }

    public function showListDetail($id) {
        $product = Product::find($id);
        return view('detail', compact('product'));
    }

    public function showListEdit($id) {
        $product = Product::find($id);
        $company_lists = Companies::all();
        return view('edit', ['product' => $product, 'company_lists' => $company_lists]);
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $company = $request->input('company');

        $query = Product::query();
        $company_lists = Companies::all();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('company_name', 'LIKE', "%{$keyword}%");
        }

        if(!empty($company)) {
            $query->where('product_name', 'LIKE', "$company")
                ->orWhere('company_name', 'LIKE', "$company");
        }

        $products = $query->get();

        return view('home', ['products' => $products, 'company_lists' => $company_lists]);
    }

    public function createProduct(ProductRequest $request)
    {
    DB::beginTransaction();

    try {
        $model = new Product();
        $model->storeProduct($request);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

    return redirect(route('showList.create'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $updateProduct = $this->product->updateProduct($request, $product);

        return redirect()->route('showList.edit', ['id'=>$product->id]);
    }

}
