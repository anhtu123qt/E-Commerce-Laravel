<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable =['order_id','product_id','product_name','product_qty','product_price'];
    protected $table = 'order_detail';

    public function product() {
        return $this->belongsTo('App\Product','product_id');
    }
}
