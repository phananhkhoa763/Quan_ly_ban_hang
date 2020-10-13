<?php

namespace App\Http\Controllers\Admin\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modal\blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Auth;
use App\Http\Requests\BlogRequest;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user  = NULL;
    protected $limit = 2;
    protected $title = '';
    private $view    = 'admin.blog.';
    public function getUserData()
    {
        $this->user = Auth::user();
        return $this->user;
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $data['blog'] = DB::table('blog')
        //     ->leftJoin('users', 'blog.user_id', '=', 'users.id')
        //     ->select('blog.*', 'users.name as nameUser')
        //     ->get();
        // return view('admin.blog.index', $data);
        $data['title']   = 'Danh Sách blog';
        $data['view']    = $this->view . 'index';
        if (!empty($request->name)) {
            $data['blog'] = blog::searchBlog($request->name, $this->limit);
        } else {
            $data['blog'] = blog::listBlog(true, $this->limit);
        }
        return view($data['view'], $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']   = 'Thêm mới blog';
        $data['view']    = $this->view . 'create';
        return view($data['view'], $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $message = 'Thêm mới blog thành công';
        $data = $request->all();
        $file = $request->img;
        $data['user_id'] = $request->userid;
        if (!empty($file)) {
            $duoiImage = $file->getClientOriginalExtension();
            $data['image'] = strtotime(date('Y-m-d H:i:s')) . '.' . $duoiImage;
            $path = public_path('upload/admin/blog-image/');
        }

        // if (blog::create($data)) {
        //     if (!empty($file)) {
        //         Image::make($file->getRealPath())->resize(846, 387)->save($path);
        //     }
        //     return redirect()->route('admin.blog.index')->with('thongbao', ' create blog thành công');
        // } else {
        //     return redirect()->back()->with('thongbao', ' Create blog error');
        // }
        try {
            blog::create($data);
            if (!empty($file)) {
                $file->move($path, $data['image']);
            }
            return redirect()->route('admin.blog.index')->with('thongbao',  $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('thongbao', ' Create blog error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = blog::find($id);
        return view('admin.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = blog::findOrFail($id);
        $message        = 'Đã cập nhật blog thành công.';
        $error_update   = 'Đã có lỗi xảy ra trong quá trình cập nhật. Vui lòng thử lại.';
        $file = $request->img;
        $img_current = public_path('upload/admin/blog-image/' . $request->imgc); // link hình cũ
        $path = public_path('upload/admin/blog-image/');
        $data = $request->all(); // lấy tất cả request
        if (!empty($file)) {
            $duoiImage = $file->getClientOriginalExtension();
            $data['image'] = strtotime(date('Y-m-d H:i:s')) . '.' . $duoiImage; //đặt tên cho hình
            $path = public_path('upload/admin/blog-image/');
        }
        try {
            if ($blog->update($data)) {
                $file->move($path, $data['image']);
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }
            return redirect()->route('admin.blog.index')->with('thongbao', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('thongbao', $error_update);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = blog::find($id);
        $file = 'H:/php/New folder/quanLyBanHang/public/upload/admin/blog-image/' . $blog->image;
        File::delete($file);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('thongbao', 'delete blog thành công');
    }
}
