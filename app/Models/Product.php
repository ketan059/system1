<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'company_name',
        'price',
        'stock',
        'comment',
        'img_path',
     ];

     // companiesモデルとの紐付け
    public function companies() {
        return $this->hasMany('App\Companies');
    }

    public function getList() {
        $products = DB::table('products')->get();

        return $products;
    }

    public function storeProduct($request) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $request->product_name,
            'company_name' => $request->company_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
        ]);
    }

    public function updateProduct($request, $product)
    {
        $result = $product->fill([
            'product_name' => $request->product_name,
            'company_name' => $request->company_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
        ])->save();

        return $result;
    }

    
}
