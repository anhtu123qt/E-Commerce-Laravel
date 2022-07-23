<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name','status'];
    protected $table = 'order_status';
    public $timestamps = false;
}
