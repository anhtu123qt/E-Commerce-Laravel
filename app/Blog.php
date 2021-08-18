<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
    	'title','image','description','content'
    ];
    public $timestamps = false;
    public function comments() {
    	return $this->hasMany('App\Comment');
    }
}
