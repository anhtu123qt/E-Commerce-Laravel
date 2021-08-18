<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'order_history';
    protected $fillable = ['email,phone,name,user_id,total'];
    public $timestamps= false;
}
