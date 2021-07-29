@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach ($category_name as $name )
        <h2 class="title text-center">{{ $name ->category_name }}</h2>
    @endforeach

    @foreach ($category_by_id as $rs)
    <a href="{{URL::to('chi-tiet-san-pham',$rs->product_id) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('public/uploads/product/'.$rs->product_image) }}"  alt="">
                            <h2>{{ number_format($rs->product_price).' '.'VNĐ' }}</h2>
                            <p>{{ $rs->product_name }}</p>
                            <a href="{{ URL::to('save-cart') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                        </div>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div><!--features_items-->
@endsection
