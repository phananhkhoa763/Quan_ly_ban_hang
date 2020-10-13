<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControllerMenu extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin/index');
    }
	public function formbasic()
    {
        return view('admin.form-basic');
    }
	public function iconmaterial()
    {       
        return view('admin.icon-material');
    }
	public function pagesprofile()
    {
        return view('admin.pages-profile');
    }
	
	public function tablebasic()
    {
        return view('admin.table-basic');
    }
}
