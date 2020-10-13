<header id="header">
	<!--header-->
	<div class="header_top">
		<!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
							<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href=""><i class="fa fa-facebook"></i></a></li>
							<li><a href=""><i class="fa fa-twitter"></i></a></li>
							<li><a href=""><i class="fa fa-linkedin"></i></a></li>
							<li><a href=""><i class="fa fa-dribbble"></i></a></li>
							<li><a href=""><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header_top-->

	<div class="header-middle">
		<!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-md-4 clearfix">
					<div class="logo pull-left">
						<a href="index.html"><img src="../../upload/frontend/images/home/logo.png" alt="" /></a> </div>
					<div class="btn-group pull-right clearfix">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								USA
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canada</a></li>
								<li><a href="">UK</a></li>
							</ul>
						</div>

						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								DOLLAR
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canadian Dollar</a></li>
								<li><a href="">Pound</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8 clearfix">
					<div class="shop-menu clearfix pull-right">
						<ul class="nav navbar-nav">
							@if(Auth::check())
							<li><a href="{{route('frontend.profile')}}"><i class="fa fa-user"></i> Account</a></li>
							<li><a onclick="event.preventDefault();document.getElementById('logout-form1').submit();"><i class="fa fa-sign-out"></i> Logout</a></li>
							<form id="logout-form1" action="{{ route('frontend.memberlogout') }}" method="POST" style="display: none;">
								@csrf
							</form>
							@else
							<li><a href="{{route('frontend.login.showLogin')}}"><i class="fa fa-lock"></i> Login</a></li>
							@endif
							<li id="Wishlistli" ><a href="{{route('frontend.Wishlist.show')}}" id="Wishlist"><i class="fa fa-star"></i>Wishlist @if(!empty(Session('session_Wishlist'))) ({{count(Session('session_Wishlist'))}}) @endif</a></li>
							<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
							<li><a href="{{route('frontend.Cart.show')}}" id="Cart"><i class="fa fa-shopping-cart"></i> Cart @if(!empty(Session('session_Cart'))) ({{count(Session('session_Cart'))}}) @endif</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header-middle-->

	<div class="header-bottom">
		<!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{route('frontend.index')}}">Home</a></li>
							<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="shop.html">Products</a></li>
									<li><a href="product-details.html">Product Details</a></li>
									<li><a href="checkout.html">Checkout</a></li>
									<li><a href="cart.html">Cart</a></li>
								</ul>
							</li>
							<li class="dropdown"><a href="#" class="active">Blog<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="{{route('frontend.blog.index')}}" class="active">Blog List</a></li>
									<li><a href="{{route('frontend.blog.show',['id'=>1])}}">Blog Single</a></li>
								</ul>
							</li>
							<li><a href="404.html">404</a></li>
							<li><a href="contact-us.html">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header-bottom-->
</header>
<!--/header-->