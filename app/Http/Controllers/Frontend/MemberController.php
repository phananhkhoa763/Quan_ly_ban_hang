<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Modal\User;



class MemberController extends Controller
{
    /**
     * Display a member.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        return view('frontend.login.login');
    }

    /**
     * Do login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = false;

        if ($request->remember_me) {
            $remember = true;
        }

        if ($this->doLogin($login, $remember)) {
            return redirect()->route('frontend.blog.index');
        } else {
            return redirect()->back()->withErrors('Email or password is not correct.');
        }
    }
    /**
     * Do login
     *
     * @param $attempt
     * @param $remember
     * @return bool
     */
    protected function doLogin($attempt, $remember)
    {

        if (Auth::attempt($attempt, $remember)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {   
        Auth::logout();
        return redirect()->route('frontend.login.showLogin');
    }
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data dulieu
     * 
     * @return \App\User
     */
    function create(Request $request)
    {
        $User = new user();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->level = 0;
        $User->save();
           
            // $login = [
            //     'email' => $User->email,
            //     'password' => $User->password,
            //     'level' => 0
            // ];

            // if ($this->doLogin($login, false)) {
            //     echo "ok";
            //     exit;
            //     return redirect()->route('frontend.blog.index');
            // } else {
            //     echo "no ok";
            //     exit;
            //     return redirect()->back()->withErrors('Email or password is not correct.');
            // }
        //}
        
    }
}
