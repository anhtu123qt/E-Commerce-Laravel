<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['district_id','district_name','district_type','city_code'];
    protected $table = 'districts';
    public $timestamps = false;
}
