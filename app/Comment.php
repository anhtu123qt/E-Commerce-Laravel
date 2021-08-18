<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['cmt_id','blog_id','content','level','name'];
    public $timestamps= false;
}
