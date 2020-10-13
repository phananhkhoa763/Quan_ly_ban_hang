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
<div class="col-lg-8 col-xlg-9 col-md-7">
    <h2>Create Product</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{route('frontend.product.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group col-md-12">
                    <div class="col-md-12">
                        <input type="text" name="name" placeholder="name" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-md-12">
                        <input type="number" placeholder="price" class="form-control form-control-line" name="price" id="price">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <select name="category_id" class="form-control form-control-line">
                            <option>please choose category </option>
                            @foreach($category as $k)
                            <option value="{{$k->id}}">{{$k->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <select name="brand_id" class="form-control form-control-line">
                            <option>please choose brand </option>
                            @foreach($brand as $k)
                            <option value="{{$k->id}}">{{$k->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <select name="status" id="status" class="form-control form-control-line">
                            <option>please choose status </option>
                            <option value="1">sale</option>
                            <option value="0">new</option>
                        </select>
                    </div>
                </div>
                <div id="sale">
                </div>
                <div class="form-group col-md-12">
                    <div class="col-md-12">
                        <input type="text" name="company_profile" placeholder="company profile" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div>
                                <input type="file" name="img[]" multiple class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-md-12">
                        <textarea rows="5" name="detail" placeholder="detail" class="form-control form-control-line"></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-12">
                        <button class="btn btn-primary">signup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var i = 0;
    $("#status").click(function() {
        var sale = $('#status').val();
        if (sale == 1 && i == 0) {
            i++;
            html = '<div class="form-group col-md-12">' +
                '<div class="col-md-12">' +
                '<input type="number" name="sale" placeholder="sale" class="form-control form-control-line">' +
                '</div>' +
                '</div>';
            $("#sale").append(html);
        } else if (sale == 0) {
            $("#sale").hide();
        }
    })
</script>
<!--/#cart_items-->
@endsection