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
<a class="btn btn-default update" style="margin-bottom: 20px;" href="{{route('frontend.product.create')}}">ADD</a>
<section id="cart_items">
    <div class="col-lg-9 col-xlg-9 col-md-9">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td>Id</td>
                        <td>web_id</td>
                        <td>Image</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($product as $k)
                    <tr>
                        <td class="cart_product">
                            {{$i++}}
                        </td>
                        <td class="cart_description">
                            {{$k->web_id}}
                        </td>
                        <?php
                        $img = json_decode($k->image);
                        ?>
                        <td class="cart_price">
                            <img class="media-object" width="50px" src="{{asset('upload/frontend/product-image/')}}/{{$img['1']}}" alt="">
                        </td>
                        <td class="cart_quantity">
                            <p>${{$k->price}}</p>
                        </td>
                        <td class="cart_delete" style="margin-top: 20px;">
                            <a class="" href="{{route('frontend.product.edit',['id'=>$k->id])}}"><i class="fa fa-pencil-square-o"></i></a>
                            <a class="" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
@endsection