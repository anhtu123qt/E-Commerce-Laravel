<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = ['ward_id','ward_name','ward_type','district_id'];
    protected $table = 'wards';
    public $timestamps = false;
}
