<?php

namespace App\modal;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'name'
    ];
    public $timestamps = true;
}
