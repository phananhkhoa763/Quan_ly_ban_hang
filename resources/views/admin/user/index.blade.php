@extends('admin.layouts.master')
@section('TenTrang','Profile')
@section('TenTrang1','Profile')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> <img src="../../upload/admin/user-image/{{Auth::user()->avatar}}" class="rounded-circle" width="150" />
                        
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>hannagover@gmail.com</h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small>
                    <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                    <div class="map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div> <small class="text-muted p-t-30 db">Social Profile</small>
                    <br />
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.user.update',['id' => Auth::user()->id])}}" enctype="multipart/form-data" method="POST">
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
                                <input type="password" required name="password" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" name="phone" required value="{{ Auth::user()->phone }}" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Địa chỉ</label>
                            <div class="col-md-12">
                                <textarea rows="5"  name="address" class="form-control form-control-line">{{ Auth::user()->address }}</textarea>
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
                            <label>Avatar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload hình</span>
                                </div>
                                <div >
                                    <input type="file" name="img" class="form-control hidden">
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
        <!-- Column -->
    </div>
</div>
@endsection