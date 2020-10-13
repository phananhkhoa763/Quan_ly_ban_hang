<?php

namespace App\Http\Controllers\Admin\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modal\country;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CsvExport;
use App\Imports\CsvImport;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user  = NULL;
    protected $limit = 5;
    protected $title = '';
    private $view    = 'admin.country.';
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
        $data['title']   = 'Danh Sách Quốc Gia';
        $data ['view']    = $this->view . 'index';
        if (!empty($request->name)) {
            $data['country'] = country::searchCountry($request->name, $this->limit);
        } else {
            $data['country'] = country::listCountry(true, $this->limit);
        }
        return view( $data ['view'], $data);
    }
    // xuất file excel
    public function export()
    {
        return Excel::download(new CsvExport, 'users.xlsx');
    }
    // nhập dữ liệu bằng file excel
    public function import()
    {
        Excel::import(new CsvImport, request()->file('file'));

        return back();
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
    public function store(CountryRequest $request)
    {
        $message = 'Đã thêm mới thành công ý kiến khách hàng.';
        try{
            country::create($request->all());

            return redirect()->route('admin.country.index')->with('thongbao', $message);

        } catch(\Exception $e){
            $error = $e->getMessage();
            return redirect()->route('admin.country.index')->with('error', $error);
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
