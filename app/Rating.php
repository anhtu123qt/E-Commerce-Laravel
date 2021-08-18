<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table='rating';
    protected $fillable = ['rating_id','blog_id','rating'];
    public $timestamps = false;
}
