@extends('admin.layouts.master')
@section('TenTrang',$title)
@section('TenTrang1',$title)
@section('content')
<div class="form-group">
    <div class="col-sm-12">
        <a href="{{route('admin.blog.create')}}" class="btn btn-success">Add Now</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">content</th>
                <th scope="col">image</th>
                <th scope="col">name user</th>
                <th scope="col">option</th>
            </tr>
        </thead>
        @php
        $i = 0;
        @endphp
        <tbody>
            @foreach($blog as $k)
            @php
            $i++
            @endphp
            <tr>
                <th scope="row">{{$i}}</th>
                <th scope="row">{{$k->title}}</th>
                <td>{!! $k->content !!}</td>
                <td><img src="../../upload/admin/blog-image/{{$k->image}}" width="200px" /></td>
                <td>{{$k->blog_user->name}}</td>
                <td>
                    <a href="{{route('admin.blog.edit', ['id' => $k->id])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
                    <a href="{{route('admin.blog.destroy',['id'=>$k->id])}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-area">
        <ul class="pagination">
            {{ $blog->links() }}
        </ul>
    </div>
</div>
@endsection