@extends('frontend.layouts.master')
@section('content')
<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
		@foreach($blog as $k)
		@php
		$date=date_create($k->updated_at);

		@endphp
		<div class="single-blog-post">
			<h3>{{$k->title}}</h3>
			<div class="post-meta">
				<ul>
					<li><i class="fa fa-user"></i>{{$k->nameUser}}</li>
					<li><i class="fa fa-clock-o"></i>{{ date_format($date,"H:i a")}}</li>
					<li><i class="fa fa-calendar"></i> {{ date_format($date,"M d,Y")}}</li>
				</ul>
				<span>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</span>
			</div>
			<a href="">
				<img src="../../upload/admin/blog-image/{{$k->image}}" alt="">
			</a>
			<p>{!!$k->content!!}</p>
			<a class="btn btn-primary" href="{{route('frontend.blog.show', ['id' => $k->id])}}">Read More</a>
		</div>
		@endforeach
		
		<div class="pagination-area">
			<ul class="pagination">
			{{ $blog->links() }}
			</ul>
		</div>
	</div>
</div>
@endsection