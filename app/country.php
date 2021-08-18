<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
	protected $table='country';
    protected $fillable= [
    	'country','description','image'
    ];
    public $timestamps = false; 
}
