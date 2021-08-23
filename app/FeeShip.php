<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    protected $fillable=['city_id','district_id','ward_id','feeship'];
    protected $table = 'feeships';
    public $timestamps = false;

    public function city() {
        return $this->belongsTo('App\City','city_id','city_code');
    }
    public function district() {
        return $this->belongsTo('App\District','district_id','district_id');
    }
    public function ward() {
        return $this->belongsTo('App\Ward','ward_id','ward_id');
    }
}
