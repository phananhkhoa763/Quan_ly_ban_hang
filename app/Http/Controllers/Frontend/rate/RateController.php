<?php

namespace App\Http\Controllers\Frontend\rate;

use App\modal\rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function create()
    {
        $rate_blog = isset($_GET['rate_blog']) ? (int) $_GET['rate_blog'] : false;
        $user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : false;
        $blog_id = isset($_GET['blog_id']) ? (int) $_GET['blog_id'] : false;
        $comment = DB::table('rate')
            ->select('id')
            ->where('user_id', '=',  $user_id)
            ->where('blog_id', '=', $blog_id)
            ->get();
        foreach ($comment as $k) {
            echo $id = $k->id;
        }
        if ($comment = null) {
            $rate = new rate();
        } else {
            $rate = rate::find($id);
        }
        $rate->user_id =  $user_id;
        $rate->blog_id =  $blog_id;
        $rate->rate_blog =  $rate_blog;
        $rate->save();
        die();
    }
}
