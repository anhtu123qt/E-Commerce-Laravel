<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code','coupon_type','coupon_amount','description','expiry'];
    protected $table = 'coupons';
}
