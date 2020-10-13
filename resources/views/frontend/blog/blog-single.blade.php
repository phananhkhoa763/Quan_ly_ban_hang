@extends('frontend.layouts.master')
@section('content')
<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
		<div class="single-blog-post">
			<h3>{{$blog->title}}</h3>
			@php
			$date=date_create($blog->updated_at);
			@endphp
			<div class="post-meta">
				<ul>
					<li><i class="fa fa-user"></i>{{$blog_user['name']}}</li>
					<li><i class="fa fa-clock-o"></i> {{ date_format($date,"H:i a")}}</li>
					<li><i class="fa fa-calendar"></i> {{ date_format($date,"M d,Y")}}</li>
					<input id="user_id" value="{{$blog_user['id']}}" type="hidden">
					<input id="blog_id" value="{{$blog->id}}" type="hidden">
				</ul>
				<span>
					<div class="rate">
						<div class="vote">
							<div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
							<div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
							<div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
							<div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
							<div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
							<span class="rate-np">rate</span>
						</div>
					</div>
				</span>
			</div>
			<a href="">
				<img src="{{asset('upload/admin/blog-image/')}}/{{$blog->image}}" alt="">
			</a>
			<p>{!!$blog->content!!}</p> <br>
			<div class="pager-area">
				<ul class="pager pull-right">
					@if($previous>0)
					<li><a href="{{route('frontend.blog.show', ['id' => $previous])}}">Pre</a></li>
					@else
					<li type="hidden"><a href="">Pre</a></li>
					@endif
					<li><a href="{{route('frontend.blog.show', ['id' => $next])}}">Next</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--/blog-post-area-->

	<div class="rating-area">
		<ul class="ratings">
			<li class="rate-this">Rate this item:</li>
			<li>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</li>
			<li class="color">(6 votes)</li>
		</ul>
		<ul class="tag">
			<li>TAG:</li>
			<li><a class="color" href="">Pink <span>/</span></a></li>
			<li><a class="color" href="">T-Shirt <span>/</span></a></li>
			<li><a class="color" href="">Girls</a></li>
		</ul>
	</div>
	<!--/rating-area-->

	<div class="socials-share">
		<a href=""><img src="images/blog/socials.png" alt=""></a>
	</div>
	<!--/socials-share-->

	<div class="media commnets">
		<a class="pull-left" href="#">
			<img class="media-object" src="images/blog/man-one.jpg" alt="">
		</a>
		<div class="media-body">
			<h4 class="media-heading">Annie Davis</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<div class="blog-socials">
				<ul>
					<li><a href=""><i class="fa fa-facebook"></i></a></li>
					<li><a href=""><i class="fa fa-twitter"></i></a></li>
					<li><a href=""><i class="fa fa-dribbble"></i></a></li>
					<li><a href=""><i class="fa fa-google-plus"></i></a></li>
				</ul>
				<a class="btn btn-primary" href="">Other Posts</a>
			</div>
		</div>
	</div>
	<!--Comments-->
	<div class="response-area">
		<h2>3 RESPONSES</h2>
		<ul class="media-list commentNew" id="commentNew">
		</ul>
		<ul class="media-list">
			@foreach($comment as $k)
			@php
			$date=date_create($k->updated_at);

			@endphp
			<li class="media" id="media">
				<a class="pull-left" href="#">
					<img class="media-object" width="136px" src="{{asset('upload/admin/user-image/')}}/{{$k->avatar}}" alt="">
				</a>
				<div class="media-body">
					<ul class="sinlge-post-meta">
						<li><i class="fa fa-user"></i>{{$k->name}}</li>
						<li><i class="fa fa-clock-o"></i> {{ date_format($date,"H:i a")}}</li>
						<li><i class="fa fa-calendar"></i>{{ date_format($date,"M d,Y")}}</li>
					</ul>
					<p>{{$k->message}}</p>
					<a class="btn btn-primary" href="#message"><i class="fa fa-reply"></i>Replay</a>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
	<!--/Response-area-->
	<div class="replay-box">
		<div class="row">
			<div class="col-sm-4">
				<h2>Leave a replay</h2>
				<form>
					<div class="blank-arrow">
						<label>Your Name</label>
					</div>
					<span>*</span>
					<input type="text" value="{{Auth::user()->name}}" placeholder="write your name...">
					<div class="blank-arrow">
						<label>Email Address</label>
					</div>
					<span>*</span>
					<input type="email" value="{{Auth::user()->email}}" placeholder="your email address...">
					<div class="blank-arrow">
						<label>Web Site</label>
					</div>
					<input type="email" value="{{Auth::user()->email}}" placeholder="current city...">
				</form>
			</div>
			<div class="col-sm-8">
				<div class="text-area">
					<div class="blank-arrow">
						<label>Your Name</label>
					</div>
					<span>*</span>
					<textarea name="message" require id="message" rows="11"></textarea>
					<a class="btn btn-primary" href="#commentNew" id="cmt">post comment</a>
				</div>
			</div>
		</div>
	</div>
	<!--/Repaly Box-->
</div>
<script>
	$("#cmt").click(function() {
		var message = $('#message').val();
		if (message === '') {
			alert('vui lòng nhập nội dung');
		} else {
			var blog_id = $("#blog_id").value;
			var url = '/blog/comment';
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
				data: {
					'message': message,
					'blog_id': blog_id
				},
				success: function(data) {
					document.getElementById('message').value = "";
					var date = new Date(data['commentNew']['date']);
					var abc = "{{asset('upload/admin/user-image/')}}" + '/' + data['commentNew']['avatar'];
					html = '<li class="media" id="media">' +
						'<a class="pull-left"  href="#">' +
						'<img class="media-object" width="136px" src="' + abc + '" alt="">' +
						'</a>' +
						'<div class="media-body">' +
						'<ul class="sinlge-post-meta">' +
						'<li><i class="fa fa-user"></i>' + data['commentNew']['name'] + '</li>' +
						'<li><i class="fa fa-clock-o"></i>' + date.toLocaleTimeString() + '</li>' +
						'<li><i class="fa fa-calendar"></i>' + date.toDateString() + '</li>' +
						'</ul>' +
						'<p>' + data['commentNew']['message'] + '</p>' +
						'<a class="btn btn-primary" href="#message"><i class="fa fa-reply"></i>Replay</a>' +
						'</div>' +
						'</li>';
					//alert(html);
					$(".commentNew").append(html);
				}
			});
		}
	})
</script>
@endsection