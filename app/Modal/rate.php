<?php

namespace App\modal;

use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
     protected $table = 'rate';
	protected $fillable = ['id','user_id','blog_id','rate_blog'];
	public $timestamps = true;
}
