<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Hash;
use App\Modal\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class MemberProfileController extends Controller
{
    public function show()
    {
        $country = DB::table('country')->get();
        return view('frontend.user.profile', compact('country'));
    }
    public function update(Request $request, $id)
    {
        $User = User::findOrFail($id);
        $deleteImage = public_path('upload/admin/user-image/' . $User['avatar']);
        $data = $request->all();
        $file = $request->img;
        if (!empty($file)) {
            $path = public_path('upload/admin/blog-image/'.$file->getClientOriginalName());
            $User->avatar = $file->getClientOriginalName();
        }
        if (isset($data['password'])) {
            $User->password = Hash::make($data['password']);
        }
        $User->name = $data['name'];
        $User->phone = $data['phone'];
        $User->address = $data['address'];
        $User->country_id = $data['country'];

        if ($User->save()) {
            if (!empty($file)) {
                if (!empty($deleteImage)) {
                    unlink($deleteImage);
                }
                Image::make($file->getRealPath())->save($path);
            }
            return redirect()->back()->with('thongbao', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }
}
