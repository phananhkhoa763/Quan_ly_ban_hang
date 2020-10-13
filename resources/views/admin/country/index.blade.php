@extends('admin.layouts.master')
@section('TenTrang',$title)
@section('TenTrang1',$title)
@section('content')
<div class="col-sm-9">
    <form action="{{route('admin.country.index')}}" class="searchform">
        @csrf
        <div class="form-group">
            <div class="col-sm-3">
                <input type="text" name="name" placeholder="tên quốc gia" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success">Tìm Kiếm</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-lg-5">
        <form action="{{route('admin.country.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label class="col-md-5">Tên Quốc Gia</label>
                <div class="col-md-5">
                    <input type="text" name="name" id="country" class="form-control form-control-line">
                    @if( $errors->has('name') )
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-7">
        <form action="{{route('admin.country.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import User Data</button>
            <a class="btn btn-warning" href="{{route('admin.country.export')}}">Export User Data</a>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @php
        $i=0;
        @endphp
        <tbody>
            @foreach($country as $key => $k)
            <tr>
                <th scope="row">{{ ($key + 1) }}</th>
                <td>{{$k->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-area">
        <ul class="pagination">
            {{ $country->appends( request()->query() )->links() }}
        </ul>
    </div>
</div>
@endsection