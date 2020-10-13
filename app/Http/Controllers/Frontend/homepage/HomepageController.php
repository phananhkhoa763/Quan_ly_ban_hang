<?php

namespace App\Http\Controllers\Frontend\homepage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modal\category;
use App\modal\brand;
use App\Modal\product;
use Illuminate\Support\Facades\Input;
use Session;
use Mail;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class HomepageController extends Controller
{
    public function index()
    {
        $category = category::all();
        $brand = brand::all();
        $product = product::all();
        return view('frontend.hompage.index', compact('category', 'brand', 'product'));
    }
    public function SeachCategory()
    {
        $category = category::all();
        $brand = brand::all();
        return view('frontend.hompage.index', compact('category', 'brand'));
    }
    public function SeachBrand()
    {
        $category = category::all();
        $brand = brand::all();
        return view('frontend.hompage.index', compact('category', 'brand'));
    }
    public function searchName(Request $request)
    {
        $category = category::all();
        $brand = brand::all();
        $product = product::select('*');
        if (isset($request->name)) {
            $product =  $product->where('name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->price)) {
            $product = $product->where('price', 'like', '%' . $request->price . '%');
        }
        if (isset($request->status)) {
            $product =  $product->where('status', $request->status);
        }
        $product = $product->get();
        return view('frontend.hompage.index', compact('category', 'brand', 'product'));
    }
    public function Ajax_PriceRange()
    {
        $data = Input::all();
        if (!empty($data['min'])) {
            $min = [$data['min']];
        } else {
            $min = [1];
        }
        if (!empty($data['max'])) {
            $max = [$data['max']];
        } else {
            $max = [1];
        }

        $product = product::select('*')->whereBetween('price', [$min, $max])->get();
        echo json_encode($product);
    }
    public function Wishlist_add()
    {
        $data = Input::all();
        $arr_id1 = [$data['id']];
        if (Session()->has('session_Wishlist')) {
            $arr_id2 = Session('session_Wishlist');
            $arr_id3 = array_merge($arr_id1, $arr_id2);
            Session()->put('session_Wishlist', $arr_id3);
        } else {
            Session()->put('session_Wishlist', $arr_id1);
        }
        echo json_encode(count(Session('session_Wishlist')));
    }
    public function Wishlist_delete()
    {
        $data = Input::all();
        $arr_id1 = $data['id'];
        $session_Wishlist1 = Session('session_Wishlist');
        foreach ($session_Wishlist1 as $k => $i) {
            if ($i == $arr_id1) {
                unset($session_Wishlist1[$k]);
            }
        }
        Session()->put('session_Wishlist', $session_Wishlist1);
        echo json_encode(count(Session('session_Wishlist')));
    }
    public function Wishlist_show()
    {
        $session_Wishlist1 = [];
        if (Session()->has('session_Wishlist')) {
            $session_Wishlist1 = Session('session_Wishlist');
        }
        $product = product::select('*')
            ->whereIn('id', $session_Wishlist1)
            ->get();
        return view('frontend.wishlist.index', compact('product'));
    }
    public function Cart_add()
    {
        $data = Input::all();
        $arr_1 = [['id' => $data['id'], 'qty' => 1]];
        if (Session()->has('session_Cart')) {
            $arr_2 = Session('session_Cart');
            $check = false;
            foreach ($arr_2 as $k => $i) {
                if ($i['id'] == $data['id']) {
                    $check = true;
                    $i['qty']++;
                    $arr_2[$k]['qty'] = $i['qty'];
                    Session()->put('session_Cart', $arr_2);
                }
            }
            if ($check == false) {
                $arr_3 = array_merge($arr_1, $arr_2);
                Session()->put('session_Cart', $arr_3);
            }
        } else {
            Session()->put('session_Cart', $arr_1);
        }
        echo json_encode(count(Session('session_Cart')));
    }
    public function Cart_show()
    {
        $arr_1 = Session('session_Cart');
        $id = [];
        $tong = 0;
        if (Session()->has('session_Cart')) {
            foreach ($arr_1 as $k => $i) {
                $id[] = $i['id'];
            }
            foreach ($arr_1 as $k => $i) {
                $product = product::select('*')
                    ->where('id', $i['id'])
                    ->get();
                foreach ($product as $j) {
                    $tong = $tong + ($j->price * $i['qty']);
                }
            }
        }

        $product = product::select('*')
            ->whereIn('id', $id)
            ->get();
        return view('frontend.cart.index', compact('product', 'arr_1', 'tong'));
    }
    public function Cart_calculation()
    {
        $data = Input::all();
        $calculation = $data['calculation'];
        $arr = Session('session_Cart');
        if ($calculation == 0) {
            foreach ($arr as $k => $i) {
                if ($i['id'] == $data['id']) {
                    $i['qty']++;
                    $qty = $i['qty'];
                    $arr[$k]['qty'] = $i['qty'];
                    Session()->put('session_Cart', $arr);
                }
            }
        } else {
            foreach ($arr as $k => $i) {
                if ($i['id'] == $data['id']) {
                    $i['qty']--;
                    $qty = $i['qty'];
                    $arr[$k]['qty'] = $i['qty'];
                    Session()->put('session_Cart', $arr);
                }
            }
        }
        echo json_encode($qty);
    }
    public function Cart_total()
    {
        $arr = Session('session_Cart');
        $tong = 0;
        if (Session()->has('session_Cart')) {
            foreach ($arr as $k => $i) {
                $product = product::select('*')
                    ->where('id', $i['id'])
                    ->get();
                foreach ($product as $j) {
                    $tong = $tong + ($j->price * $i['qty']);
                }
            }
        }
        echo json_encode($tong);
    }
    public function Cart_delete()
    {
        $data = Input::all();
        $arr = Session('session_Cart');
        foreach ($arr as $k => $i) {
            if ($i['id'] == $data['id']) {
                unset($arr[$k]);
            }
        }
        Session()->put('session_Cart', $arr);
        echo json_encode(count(Session('session_Cart')));
    }
    public function sendMail()
    {
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('frontend.blocks.error-404', [], function ($message) {
            $email = 'phananhkhoa763@gmail.com';
            $message
                ->to($email, 'Howdy buddy!')
                ->subject('Test Mail!');
        });
        return Redirect::back();
        //return view('welcome');
    }
}
