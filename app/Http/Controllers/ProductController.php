<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Companies;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

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

        $result = Product::query()
        ->select('products.*', 'companies.company_name')
        ->join('companies','products.company_id','=','companies.id');

        $result->where('products.id', '=', "$id");
        $product = $result->first();

        return view('detail', ['product' => $product]);
    }

    public function showListEdit($id) {
        $result = Product::query()
                ->select('products.*', 'companies.company_name')
                ->join('companies','products.company_id','=','companies.id');

        $result->where('products.id', '=', "$id");
        $product = $result->first();

        $company_lists = Companies::all();

        return view('edit', ['product' => $product, 'company_lists' => $company_lists]);

    }

    public function index(Request $request)
    {
        $keyword = session('search.keyword');
        $company = session('search.company');
        $minPrice = session('search.minPrice');
        $maxPrice = session('search.maxPrice');
        $minStock = session('search.minStock');
        $maxStock = session('search.maxStock');

        $query = Product::query()
               ->select('products.*', 'companies.company_name')
               ->join('companies','products.company_id','=','companies.id');

        $company_lists = Companies::all();

        if(!empty($keyword)) {
            $query->where('products.product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('companies.company_name', 'LIKE', "%{$keyword}%");
        }

        if(!empty($company)) {
            $query->where('products.company_id', '=', "$company");
        }

        if((isset($minPrice)) && (isset($maxPrice))) {
            $query->whereBetween('products.price',[$minPrice, $maxPrice]);
        } elseif(isset($minPrice)) {
            $query->where('products.price', '>=', $minPrice);
        } elseif(isset($maxPrice)) {
            $query->where('products.price', '<=', $maxPrice);
        }

        if((isset($minStock)) && (isset($maxStock))) {
            $query->whereBetween('products.stock',[$minStock, $maxStock]);
        } elseif(isset($minStock)) {
            $query->where('products.stock', '>=', $minStock);
        } elseif(isset($maxStock)) {
            $query->where('products.stock', '<=', $maxStock);
        }

        $products = $query->sortable('id','desc')->get();

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

    /*
    public function deletee($id)
    {
        $deleteProduct = $this->product->deleteProductById($id);
        return redirect()->route('product.index');
    }

    public function deleteee(Request $request, Product $products)
    {
        $products = Product::findOrFail($request->id);
        $products->delete();
    }
    */

    public function destroy(Request $request) {
        // dd($request);
        $input = $request->all();
        // dd($input);
            DB::beginTransaction();
    
            try {
              $product = Product::find($input['id']); 
              $product->delete();
    
              DB::commit();
              return response()->json(['success' => true]);
    
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, 'message' => '削除に失敗しました']);
            }
        }

    public function search(Request $request) {
        $keyword = request()->get('keyword');
        $company = request()->get('company');
        $minPrice = request()->get('minPrice');
        $maxPrice = request()->get('maxPrice');
        $minStock = request()->get('minStock');
        $maxStock = request()->get('maxStock');

        session_start();
        session([
            'search.keyword' => $keyword,
            'search.company' => $company,
            'search.minPrice' => $minPrice,
            'search.maxPrice' => $maxPrice,
            'search.minStock' => $minStock,
            'search.maxStock' => $maxStock,
            ]);

        $query = Product::query()
               ->select('products.*', 'companies.company_name')
               ->join('companies','products.company_id','=','companies.id');


        if(!empty($keyword)) {
            $query->where('products.product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('companies.company_name', 'LIKE', "%{$keyword}%");
        }

        if(!empty($company)) {
            $query->where('products.company_id', '=', "$company");
        }

        if((isset($minPrice)) && (isset($maxPrice))) {
            $query->whereBetween('products.price',[$minPrice, $maxPrice]);
        } elseif(isset($minPrice)) {
            $query->where('products.price', '>=', $minPrice);
        } elseif(isset($maxPrice)) {
            $query->where('products.price', '<=', $maxPrice);
        }

        if((isset($minStock)) && (isset($maxStock))) {
            $query->whereBetween('products.stock',[$minStock, $maxStock]);
        } elseif(isset($minStock)) {
            $query->where('products.stock', '>=', $minStock);
        } elseif(isset($maxStock)) {
            $query->where('products.stock', '<=', $maxStock);
        }
        

        $products = $query->sortable('id','desc')->get();

        return response()->json(['products' => $products]);
    }

}
