@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <form action="{{ URL::to('update-cart-ajax') }}" method="post">
                @csrf
                <table class="table table-condensed">

                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="name">Tên sản phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach (Session::get('cart') as $cart )
                            @php
                                $sub_total = $cart['product_price'] * $cart['product_qty'] ;
                                $total += $sub_total;
                            @endphp

                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset('public/uploads/product/'.$cart['product_image']) }}" style="width:60px;" src="" alt=""></a>
                                </td>
                                <td class="cart_name">
                                    <h4><a href="">{{ $cart['product_name'] }}</a></h4>
                                    <p>Mã sản phẩm:{{ $cart['product_id'] }} </p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($cart['product_price']).' vnđ' }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                            <input class="cart_quantity" type="number" name="cart_qty[{{ $cart['session_id'] }}]" min="1" value="{{ $cart['product_qty'] }}" size="2">
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        {{ number_format($sub_total).' vnđ' }}
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{ url::to('delete-cart-ajax',$cart['session_id']) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default btn-sm check_out">
                                </td>
                            </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <h4 style="margin:20px; font-size:20px;">Chọn hình thức thanh toán:</h4>
        <form action="{{ URL::to('order-place') }}" method="post">
            @csrf
        <div class="payment-option">
            <span>
                <label><input name="payment_option" value="ATM" type="checkbox">Thanh toán tiền mặt</label>
            </span>
            <span style="margin-left:20px;">
                <label><input name="payment_option" value="Tiền mặt" type="checkbox">Thanh toán bằng thẻ</label>
            </span>
        </div>
        </form>

    </div>
</section> <!--/#cart_items-->
@endsection
