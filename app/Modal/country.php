<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
	protected $table = 'country';
	protected $fillable = ['name'];
	public $timestamps = false;

	public static function searchCountry($name = null, $limit = 10)
	{
		return country::where([
			['name', 'like', '%' . mb_strtolower($name, 'UTF-8') . '%']
		])->orderBy('id', 'DESC')->paginate($limit);
	}
	public static function listCountry($paginate = false, $limit = 10)
	{
		if($paginate){
			return country::orderBy('id', 'DESC')->paginate($limit);
		}else{
			return	country::orderBy('id', 'DESC')->get();
		}
	}
}
