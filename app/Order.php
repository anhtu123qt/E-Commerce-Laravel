<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['user_id','shipping_charges','shipping_city','shipping_district','shipping_ward','shipping_address_detail','phone','coupon_code','coupon_type','coupon_amount','order_status','payment_method','grand_total'];
    protected $table = 'order';
}
