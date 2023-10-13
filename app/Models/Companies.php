<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
//
protected $fillable = ['company_name'];

// Productモデルへの紐付け
public function Product() {
return $this->belongsTo('App\Product');
}

}
