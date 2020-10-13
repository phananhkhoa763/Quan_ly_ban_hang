@extends('frontend.layouts.master')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach($product as $k)
                    <div class="col-sm-4 " id="product{{$k->id}}" >
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
                                    <li onclick="getPaging(this.id)" id="addWish{{$k->id}}" value="1"><a id="addWish{{$k->id}}i"><i class="fa fa-plus-square"></i>remove to wishlist</a></li>
                                    <li><a><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--features_items-->
            </div>
        </div>
    </div>
</section>
<script>
    function getPaging(a) {
        var id = $('#' + a + 'k').val();
        var Wishlist = $('#' + a).val();
        if (Wishlist == 1) {
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
                    $('#product'+id).css('display','none');
                }
            });
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
</script>
@endsection