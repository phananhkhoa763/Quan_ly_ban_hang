@extends('admin.layouts.master')
@section('TenTrang','edit blog')
@section('TenTrang1','edit blog')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <form action="{{route('admin.blog.update', ['id' => $blog->id])}}" enctype="multipart/form-data" method="POST" class="form-horizontal m-t-30">
                    @csrf
                    <div>
                    </div>
                    <input type="hidden" name="userid" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <label> <span class="help">title</span></label>
                        <input type="text" name="title" value="{{$blog->title}}" class="form-control">
                        @if( $errors->has('title') )
                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>content</label>
                        <textarea class="form-control" name="content" id="content" rows="5">{!!$blog->content!!}</textarea>
                        @if( $errors->has('content') )
                        <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload image</span>
                            </div>
                            <div>
                                <input type='file' name="img" id="imgInp" />
                                <input type='hidden' name="imgc" value="{{$blog->image}}" />
                                <img id="blah" src="{{asset('upload/admin/blog-image/')}}/{{$blog->image}}" style="width:200px" alt="your image" />

                            </div>
                        </div>
                        @if( $errors->has('img') )
                        <div class="alert alert-danger">{{ $errors->first('img') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Update blog</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl: '{{ asset('ckfinder / ckfinder.html ') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder / ckfinder.html ? type = Images ') }}',
        filebrowserFlashBrowseUrl : '{{ asset('ckfinder / ckfinder.html ? type = Flash ') }}',
        filebrowserUploadUrl : '{{ asset('ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Files ') }}',
        filebrowserImageUploadUrl : '{{ asset('ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Images ') }}',
        filebrowserFlashUploadUrl : '{{ asset('ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Flash ') }}'
    });
</script>
@endsection