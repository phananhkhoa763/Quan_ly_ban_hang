<?php

namespace App\modal;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comment';
	protected $fillable = ['user_id','blog_id','rate_blog'];
	public $timestamps = true;
}
