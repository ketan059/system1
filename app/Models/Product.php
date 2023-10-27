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
        'company_id',
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

    public function getCompanyNameById()
  {
    return DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->get();
  }

    public function storeProduct($request) {
        // 登録処理

        $dir = 'image';
        if(!empty($request->file('img_path'))){
            $file_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/' . $dir, $file_name);
        } else {
            $file_name = null;
        }

        DB::table('products')->insert([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => 'storage/' . $dir . '/' . $file_name,
        ]);

    }

    public function updateProduct($request, $product)
    {
        $dir = 'image';
        if(!empty($request->file('img_path'))){
            $file_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/' . $dir, $file_name);
        } else {
            $file_name = null;
        }

        $result = $product->fill([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => 'storage/' . $dir . '/' . $file_name,
        ])->save();

        return $result;
    }

    public function deleteProductById($id)
    {
        return $this->destroy($id);
    }

    
}
