<!DOCTYPE html><html lang="en"><head>    <meta charset="utf-8">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <meta name="description" content="">    <meta name="author" content="">    <title>@yield('title') | E-Shopper</title>    <link href="{{ asset('css/frontend/css/bootstrap.min.css') }}" rel="stylesheet">    <link href="{{ asset('css/frontend/css/font-awesome.min.css') }}" rel="stylesheet">    <link href="{{ asset('css/frontend/css/prettyPhoto.css') }}" rel="stylesheet">    <link href="{{ asset('css/frontend/css/price-range.css') }}" rel="stylesheet">    <link href="{{ asset('css/frontend/css/animate.css') }}" rel="stylesheet">    <link href="{{ asset('css/frontend/css/main.css') }}" rel="stylesheet">    <link href="{{ asset('css/frontend/css/responsive.css') }}" rel="stylesheet">    <link type="text/css" rel="stylesheet"  href="{{ asset('css/rate/css/rate.css') }}">        <!--[if lt IE 9]>    <script src="js/html5shiv.js"></script>    <script src="js/respond.min.js"></script>    <![endif]-->    <link rel="shortcut icon" href="../../upload/frontend/images/ico/favicon.ico">    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../upload/frontend/images/ico/apple-touch-icon-144-precomposed.png">    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../upload/frontend/images/ico/apple-touch-icon-114-precomposed.png">    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../upload/frontend/images/ico/apple-touch-icon-72-precomposed.png">    <link rel="apple-touch-icon-precomposed" href="../../upload/frontend/images/ico/apple-touch-icon-57-precomposed.png">    <script src="{{ asset('js/frontend/js/jquery.js') }}"></script></head><!--/head--><body>    @include('frontend.layouts.header')    <section>        <div class="container">            <div class="row">                @yield('content')            </div>        </div>    </section>    @include('frontend.layouts.footer')        <script src="{{ asset('js/frontend/js/price-range.js') }}"></script>    <script src="{{ asset('js/frontend/js/jquery.scrollUp.min.js') }}"></script>    <script src="{{ asset('js/frontend/js/bootstrap.min.js') }}"></script>    <script src="{{ asset('js/frontend/js/jquery.prettyPhoto.js') }}"></script>    <script src="{{ asset('js/frontend/js/main.js') }}"></script>    <script src="{{ asset('js/rate.js') }}"></script>	    <!-- <script src="js/jquery.js"></script>	<script src="js/price-range.js"></script>	<script src="js/jquery.scrollUp.min.js"></script>	<script src="js/bootstrap.min.js"></script>    <script src="js/jquery.prettyPhoto.js"></script>    <script src="js/main.js"></script> --></body></html>