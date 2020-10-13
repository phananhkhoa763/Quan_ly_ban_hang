<?php

namespace App\Http\Controllers\frontend\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modal\blog;
use App\modal\rate;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\RequestException;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // $limit = 2;
        // $data['limit'] = $limit;
        // $client = new \GuzzleHttp\Client();
        // $request = $client->request('GET', asset("") . 'api/blog', [
           
        // ]);
        // $response = json_decode($request->getBody(), false);

        // dd($response);
        // $client = new \GuzzleHttp\Client();
        // echo asset("") . 'api/blog';
        // exit;
        // // Create a request
        // $request = $client->get(asset("") . 'api/blog');
        // // Get the actual response without headers
        // $response = $request->getBody();
        // dd($response);

        // exit;
        $data['blog'] = DB::table('blog')
            ->leftJoin('users', 'blog.user_id', '=', 'users.id')
            ->select('blog.*', 'users.name as nameUser')
            ->paginate(2);
        return view('frontend/blog/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = DB::table('blog')
            ->leftJoin('comment', 'blog.id', '=', 'comment.blog_id')
            ->leftJoin('users', 'comment.user_id', '=', 'users.id')
            ->select('comment.*', 'users.name', 'users.avatar')
            ->where('blog.id', '=', $id)
            ->get();
        $blog_user = blog::find($id)->blog_user->toArray();
        $blog = blog::find($id);
        $previous = blog::where('id', '<', $blog->id)->max('id');
        $next = blog::where('id', '>', $blog->id)->min('id');
        $user_rate = blog::with(['blog_rate' => function ($q) {
        }])->find($id)->toArray();
        return view('frontend/blog/blog-single', compact('blog', 'previous', 'next', 'blog_user', 'user_rate', 'comment'));
    }

    /**$blog = Blog::find($id); 
        $previous = Blog::where('id', '<', $blog->id)->max('id');
        $next = Blog::where('id', '>', $blog->id)->min('id');
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
