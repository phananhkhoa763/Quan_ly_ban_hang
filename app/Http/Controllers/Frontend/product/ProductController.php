<?php

namespace App\Http\Controllers\Frontend\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modal\product;
use App\modal\category;
use App\modal\brand;
use Intervention\Image\Facades\Image as Image;
use Auth;


class ProductController extends Controller
{
    public function index()
    {
        $product = product::all();
        return view('frontend.product.index', compact('product'));
    }
    public function create()
    {
        $category = category::all();
        $brand = brand::all();
        return view('frontend.product.create', compact('category', 'brand'));
    }
    protected function saveImage($request)
    {
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $image) {
                $name = strtotime(date('Y-m-d H:i:s')) . '_' . $image->getClientOriginalName();
                $name_2 = "img2_" . $name;
                $name_3 = "img3_" . $name;
                //$image->move('upload/product/', $name);
                $path = public_path('upload/frontend/product-image/' . $name);
                $path2 = public_path('upload/frontend/product-image/' . $name_2);
                $path3 = public_path('upload/frontend/product-image/' . $name_3);
                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                $data1[] = $name;
            }
            return $data1;
        }
    }
    protected function deleteImage($imgDelete)
    {
        if (!empty($imgDelete)) {
            foreach ($imgDelete as $k) {
                $deleteImage = public_path('upload/frontend/product-image/' . $k);
                $deleteImage1 = public_path('upload/frontend/product-image/' . "img2_" . $k);
                $deleteImage2 = public_path('upload/frontend/product-image/' . "img3_" . $k);
                if (!empty($deleteImage)) {
                    unlink($deleteImage);
                }
                if (!empty($deleteImage1)) {
                    unlink($deleteImage1);
                }
                if (!empty($deleteImage2)) {
                    unlink($deleteImage2);
                }
            }
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['web_id'] = '1089772';
        $data1 = [];
        $data1 = $this->saveImage($request);
        $data['image'] = json_encode($data1);
        if (product::create($data)) {
            return redirect('member/product/create')->with('success', __('Create product success.'));
        } else {
            return redirect()->back()->withErrors('Create blog error.');
        }
    }
    public function edit($id)
    {
        $category = category::all();
        $brand = brand::all();
        $product = product::find($id);
        $img = json_decode($product->image);
        return view('frontend.product.update', compact('product', 'category', 'brand', 'img'));
    }
    public function update(Request $request, $id)
    {
        $product = product::find($id);
        $data1 = [];
        $data = $request->all();
        $imgDelete = $request->imgDelete; // số hình xóa
        if (!empty($imgDelete)) {
            $imgRest = array_diff(json_decode($product->image), $imgDelete); // hình còn lạis
            foreach ($imgRest as $k) {
                $data1[] = $k;
            }
        }
        $sumImage = count($data1) + count($request->file('img')); // tổng file hình còn lại và update
        if ($sumImage <= 3 && $sumImage > 1) {
            $data1 = $this->saveImage($request);
            $data['image'] = json_encode($data1);
            if ($product->update($data)) {
                $this->deleteImage($imgDelete);
                return redirect('member/product/create')->with('thongbao', __('update product success.'));
            } else {
                return redirect()->back()->with('thongbao', 'update product error.');
            }
        } else {
            return redirect()->back()->with('thongbao', 'update (image <=3 and image > 1) product error.');
        }
    }
    public function destroy($id)
    {
        $product = product::find($id);
        $imgDelete = json_decode($product->image);
        $this->deleteImage($imgDelete);
        if ($product->delete()) {

            return redirect('member/product/create')->with('success', 'Delete blog success.');
        } else {

            return redirect('member/product/create')->withErrors('Delete blog error.');
        }
    }
}
