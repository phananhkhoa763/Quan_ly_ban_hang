@extends('frontend.layouts.master1')
@section('content')
<div class="col-sm-9">
    <form action="{{route('frontend.index.searchName')}}" class="searchform">
        @csrf
        <div class="col-sm-3">
            <input type="text" name="price" placeholder="price" />
        </div>
        <div class="col-sm-3">
            <input type="text" name="name" placeholder="name" />
        </div>
        <div class="col-sm-3">
            <select name="status" id="status">
                <option value="">Chọn</option>
                <option value="1">sale</option>
                <option value="0">new</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">search</button>
    </form>
</div>
<div class="col-sm-3">
</div>
<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('upload/frontend/images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
                                <img src="{{asset('upload/frontend/images/home/pricing.png')}}" class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('upload/frontend/images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
                                <img src="{{asset('upload/frontend/images/home/pricing.png')}}" class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('upload/frontend/images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
                                <img src="{{asset('upload/frontend/images/home/pricing.png')}}" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/slider-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach($category as $k)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">{{$k->name}}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/category-products-->

                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($brand as $k)
                                <li><a href="#"> <span class="pull-right">(50)</span>{{$k->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--/brands_products-->

                    <div class="price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            <input type="hidden" id="min" />
                            <input type="hidden" id="max" />
                        </div>
                        <a id="Pricerange" onclick="getPricerange()" class="btn btn-warning">search</a>
                    </div>
                    <!--/price-range-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach($product as $k)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <?php
                                    $img = json_decode($k->image);
                                    ?>
                                    <img src="{{asset('upload/frontend/product-image/')}}/{{$img['1']}}" alt="" />
                                    @if($k->status==0)
                                    <h2>${{$k->price}}</h2>
                                    @else
                                    <?php
                                    $sale = $k->price - (($k->price / 100) * $k->sale);
                                    ?>
                                    <h2>$<strike>{{$k->price}}</strike>->${{$sale}}</h2>
                                    @endif
                                    <p>{{$k->name}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        @if($k->status==0)
                                        <h2>${{$k->price}}</h2>
                                        @else
                                        <h2>$<strike>{{$k->price}}</strike>->${{$sale}}</h2>
                                        @endif
                                        <p>{{$k->name}}</p>
                                        <a onclick="getCart({{$k->id}})" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                                @if($k->status==0)
                                <img src="{{asset('upload/frontend/images/home/new.png')}}" class="new" alt="" />
                                @else
                                <img src="{{asset('upload/frontend/images/home/sale.png')}}" class="new" alt="" />
                                @endif
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <input type="hidden" id="addWish{{$k->id}}k" value="{{$k->id}}"></input>
                                    <li onclick="getPaging(this.id)" id="addWish{{$k->id}}" value="0"><a id="addWish{{$k->id}}i"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--features_items-->

                <div class="category-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
                            <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
                            <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
                            <li><a href="#kids" data-toggle="tab">Kids</a></li>
                            <li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tshirt">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery4.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="blazers">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery4.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="sunglass">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery4.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kids">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery4.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="poloshirt">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery4.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->
            </div>
        </div>
    </div>
</section>
@endsection
<script>
    function getPaging(a) {
        var id = $('#' + a + 'k').val();
        var Wishlist = $('#' + a).val();
        if (Wishlist == 0) {
            $('#' + a).val('1');
            var url = '/Wishlist';
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    'id': id,
                },
                success: function(data) {
                    $('#Wishlist').html('<i class="fa fa-star"></i> Wishlist(' + data + ')');

                }
            });
            $('#' + a + 'i').html('<i class="fa fa-plus-square"></i>remove to wishlist');
        } else {
            $('#' + a).val('0');
            var url = '/Wishlist/delete';
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    'id': id,
                },
                success: function(data) {
                    $('#Wishlist').html('<i class="fa fa-star"></i> Wishlist(' + data + ')');

                }
            });
            $('#' + a + 'i').html('<i class="fa fa-plus-square"></i>Add to wishlist');
        }
    }

    function getCart(a) {
        var id = a;
        var url = '/Cart/add';
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: {
                'id': id,
            },
            success: function(data) {
                $('#Cart').html('<i class="fa fa-shopping-cart"></i> Cart(' + data + ')');
            }
        });
    }

    function getPricerange() {
        var min = $('#min').val();
        var max = $('#max').val();
        var url = '/PriceRange';
        $('.features_items').html('');
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: {
                'min': min,
                'max': max,
            },
            success: function(data) {
                data.forEach(k => {
                    var img = JSON.parse(k.image);
                    html = ' <div class="col-sm-4">'+
                        '<div class="product-image-wrapper">'+
                            '<div class="single-products">'+
                                '<div class="productinfo text-center">'+
                                    '<img src="{{asset("upload/frontend/product-image/")}}/'+img[1]+'" alt="" />'+
                                        ' <h2>$'+k.price+'</h2>'+
                                        '<h2>$<strike>'+k.price+'</strike>->${{$sale}}</h2>'+
                                     '<p>'+k.name+'</p>'+
                                    '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>'+
                                '</div>'+
                                '<div class="product-overlay">'+
                                    '<div class="overlay-content">'+
                                        '<h2>$'+k.price+'</h2>'+
                                        '<p>'+k.name+'</p>'+
                                       '<a onclick="getCart('+k.id+')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>'+
                                    '</div>'+
                                '</div>'+
                               
                                '<img src="{{asset("upload/frontend/images/home/sale.png")}}" class="new" alt="" />'+
                            '</div>'+
                            '<div class="choose">'+
                                '<ul class="nav nav-pills nav-justified">'+
                                    '<input type="hidden" id="addWish'+k.id+'k" value="'+k.id+'"></input>'+
                                    '<li onclick="getPaging(this.id)" id="addWish'+k.id+'" value="0"><a id="addWish'+k.id+'i"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>'+
                                    '<li><a><i class="fa fa-plus-square"></i>Add to compare</a></li>'+
                               '</ul>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                    $(".features_items").append(html);
                });
            }
        });
    }
</script>
<!--
abc = [id, qty];
    => ss['cart'][] =  abc
-->