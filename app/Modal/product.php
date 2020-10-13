<?php

namespace App\modal;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'category_id', 'brand_id', 'user_id', 'name', 'image', 'web_id',
        'price', 'status', 'sale', 'condition', 'detail', 'company_profile', 'highlight', 'active'
    ];
    public $timestamps = true;
}
