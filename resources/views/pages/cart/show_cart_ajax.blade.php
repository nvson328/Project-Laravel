@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
            <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color: red;
                    font: 17px;
                    width: 100%;
                    text-align: center;
                    font-weight: bold;">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
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
        <section id="do_action">
            <div class="container">
                {{--  <div class="heading">
                    <h3>What would you like to do next?</h3>
                    <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                </div>  --}}
                <div class="row">

                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng <span>{{ number_format($total).' vnđ' }}</span></li>
                                <li>Thuế <span>{{ Cart::tax() }}</span></li>
                                <li>Phí vận chuyển<span>Miễn phí</span></li>
                                <li>Thành tiền <span>{{ number_format($total).' vnđ' }}</span></li>
                            </ul><br>
                            <?php
                                $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                            ?>
                                    <a style="float:right;" class="btn btn-default check_out" href="{{ URL::to('checkout') }}">Thanh toán</a>
                            <?php
                                    }else{
                            ?>
                                <a style="float:right;" class="btn btn-default check_out" href="{{ URL::to('login-checkout') }}">Thanh toán</a>
                            <?php
                                    }
                            ?>
                            <a style="float:right;" class="btn btn-default check_out" href="{{ URL::to('login-checkout') }}">Nhập mã giảm giá</a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    </div>
</section> <!--/#cart_items-->
@endsection
