<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
	protected $table = 'blog';
	protected $fillable = ['title', 'content', 'image', 'user_id'];
	public $timestamps = true;
	public function blog_user()
	{
		return $this->belongsTo('App\Modal\User', 'user_id', 'id');
	}
	public function blog_rate()
	{
		return $this->hasMany('App\Modal\rate', 'blog_id');
	}
	public static function searchBlog(){
		
	}
	public static function listBlog($paginate = false, $limit = 10){
		if($paginate){
			return	blog::with('blog_user')->orderBy('id', 'DESC')->paginate($limit);
		}else{
			return blog::with('blog_user')->orderBy('id', 'DESC')->get();
		}
	}
}
