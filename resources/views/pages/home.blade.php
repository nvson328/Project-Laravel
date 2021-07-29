@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach ($product as $rs)

    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <form method ="post">
                            @csrf
                        <input type="hidden" value="{{$rs->product_id}}" class="cart_product_id_{{$rs->product_id}}">
                        <input type="hidden" value="{{$rs->product_name}}" class="cart_product_name_{{$rs->product_id}}">
                        <input type="hidden" value="{{$rs->product_image}}" class="cart_product_image_{{$rs->product_id}}">
                        <input type="hidden" value="{{$rs->product_price}}" class="cart_product_price_{{$rs->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$rs->product_id}}">
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$rs->product_id)}}">
                            <img src="{{URL::to('public/uploads/product/'.$rs->product_image)}}" alt="" />
                            <h2>{{number_format($rs->product_price).' '.'VNĐ'}}</h2>
                            <p>{{$rs->product_name}}</p>
                        </a>
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$rs->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                        </form>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div><!--features_items-->
@endsection
