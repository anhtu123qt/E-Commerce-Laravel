<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['city_code','city_name','city_type'];
    protected $table = 'cities';
    public $timestamps = false;
}
