<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Product';
    protected $fillable = ['product_name','product_price','product_category','product_brand','product_status','product_sale_price','product_image','product_detail'];
    public function categories() {
        return $this->belongsTo(Category::class,'product_category');
    }
    public function brands() {
        return $this->belongsTo(Brand::class,'product_brand');
    }
}
