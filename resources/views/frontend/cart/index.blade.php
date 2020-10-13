@extends('frontend.layouts.master1')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($product))
                    @foreach($product as $k)
                    <?php
                    $img = json_decode($k->image);
                    ?>
                    <tr class="product{{$k->id}}">
                        <td class="cart_product">
                            <a href=""><img width="120px" src="{{asset('upload/frontend/product-image/')}}/{{$img['1']}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$k->name}}</a></h4>
                            <p>Web ID:{{$k->web_id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{$k->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" onclick="getPlusCart({{$k->id}},{{$k->price}})"> + </a>
                                @foreach($arr_1 as $value =>$key)
                                @if($key['id']==$k->id)
                                <?php
                                $qty = $key['qty'];
                                ?>
                                <input class="cart_quantity_input" type="text" id="qtyCart{{$k->id}}" name="quantity" value="{{$key['qty']}}" autocomplete="off" size="2">
                                @endif
                                @endforeach
                                <a class="cart_quantity_down" onclick="getMinusCart({{$k->id}},{{$k->price}})"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" id="cart_total_price{{$k->id}}">${{$qty*$k->price}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" onclick="getDelete({{$k->id}})"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span id="Total">${{$tong}}</span></li>
                    </ul>
                    <a class="btn btn-default update" onclick="getUpdate()">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script>
    function getPlusCart(a, b) {
        var id = a;
        var calculation = 0;
        var url = '/Cart/calculation';
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: {
                'calculation': calculation,
                'id': id,
            },
            success: function(data) {
                var cart_total_price = b * data;
                var kk = '$';
                $('#cart_total_price' + a).html('' + kk + cart_total_price + '');
                $('#qtyCart' + a).val(data);
            }
        });
    }

    function getMinusCart(a, b) {
        var id = a;
        var calculation = 1;
        var url = '/Cart/calculation';
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: {
                'calculation': calculation,
                'id': id,
            },
            success: function(data) {
                var cart_total_price = b * data;
                var kk = '$';
                $('#cart_total_price' + a).html('' + kk + cart_total_price + '');
                $('#qtyCart' + a).val(data);
            }
        });
    }

    function getUpdate() {
        var url = '/Cart/total';
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                var kk = '$';
                $('#Total').html('' + kk + data + '');
            }
        });
    }

    function getDelete(a) {
        var id = a;
        var url = '/Cart/delete';
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: {
                'id': id,
            },
            success: function(data) {
                $('#Cart').html('<i class="fa fa-shopping-cart"></i> Cart(' + data + ')');
                $('.product' + id).css('display', 'none');
            }
        });
    }
    //
</script>
<!--/#do_action-->