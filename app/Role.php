<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
