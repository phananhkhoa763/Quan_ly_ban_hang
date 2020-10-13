<?php

namespace App\Http\Controllers\Frontend\comment;
use App\modal\comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Modal\User;

class CommentController extends Controller
{
    public function create()
    {
        $userName = User::find(Auth::id());
        $message = isset($_GET['message']) ? (String) $_GET['message'] : false;
        $blog_id = isset($_GET['blog_id'])? (int) $_GET['blog_id'] : false;
        $comment = new comment();
        $comment->message =  $message;
        $comment->blog_id =  $blog_id;
        $comment->user_id =  Auth::id();
        $comment->blogReplay_id = 0;
        $comment->save();
        $array = array(
            "name" => $userName->name,
            "avatar" => $userName->avatar,
            "message" => $comment->message,
            "date" => $comment->created_at,
        );
        if($comment->save()){
            return response()->json([
                'success'=>'You have comment this product successfully  ✔',
                'commentNew'=>$array,
                ]);
        }
           

    }
}
