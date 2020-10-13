@extends('frontend.layouts.master1')
@section('content')
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Account</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Account
                        </a>
                    </h4>
                </div>
                <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="{{route('frontend.profile')}}">info Account </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            MY PRODUCT
                        </a>
                    </h4>
                </div>
                <div id="mens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="{{route('frontend.product.index')}}">show product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8 col-xlg-9 col-md-7">
    <h2>User Update</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{route('frontend.profile.update',['id' => Auth::user()->id])}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label class="col-md-12">Full Name</label>
                    <div class="col-md-12">
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Email</label>
                    <div class="col-md-12">
                        <input type="email" value="{{ Auth::user()->email }}" readonly class="form-control form-control-line" name="example-email" id="example-email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Password</label>
                    <div class="col-md-12">
                        <input type="password" name="password" value="" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Phone No</label>
                    <div class="col-md-12 ">
                        <input type="text" name="phone" required value="{{ Auth::user()->phone }}" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Địa chỉ</label>
                    <div class="col-md-12 ">
                        <textarea rows="2" name="address" class="form-control form-control-line">{{ Auth::user()->address }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12">Select Country</label>
                    <div class="col-sm-12">
                        <select name="country" class="form-control form-control-line">
                            <option>Chọn Tên Quốc Gia </option>
                            @foreach($country as $k)
                            @if(Auth::user()->country_id == $k->id)
                            <option value="{{$k->id}}" selected>{{$k->name}}</option>
                            @else
                            <option value="{{$k->id}}">{{$k->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Avatar</label>
                        <div class="input-group">
                            <div>
                                <input type="file" name="img" class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection