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
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
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
                    @foreach ($content as $cart )
                        <tr>
                            <td class="cart_product">
                                <a href=""><img style="width:60px;" src="{{ asset('public/uploads/product/'.$cart->options->image) }}" alt=""></a>
                            </td>
                            <td class="cart_name">
                                <h4><a href="">{{ $cart->name }}</a></h4>
                                <p>Mã sản phẩm: {{ $cart->id }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart->price).'vnđ' }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="{{ URL::to('update-qty') }}" method="post">
                                        @csrf
                                        <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{ $cart->qty }}" size="2">
                                        <input type="hidden" value="{{ $cart->rowId }}" name="row_id" class="form-control">
                                        <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php
                                        $subtotal = $cart->price * $cart->qty;
                                        echo number_format($subtotal).' vnđ';
                                    ?>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ URL::to('delete-cart',$cart->rowId) }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
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
                        <li>Tổng <span>{{ Cart::subtotal().' '.'vnđ' }}</span></li>
                        <li>Thuế <span>{{ Cart::tax() }}</span></li>
                        <li>Phí vận chuyển<span>Miễn phí</span></li>
                        <li>Thành tiền <span>{{ Cart::total().' vnđ' }}</span></li>
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
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
