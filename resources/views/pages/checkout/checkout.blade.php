@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Thông tin người nhận</p>
                        <div class="form-one">
                            <form method="post" action="{{ URL::to('save-checkout') }}">
                                @csrf
                                <input type="text" name="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" placeholder="Họ và tên">
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                <textarea name="shipping_notes" placeholder="Ghi chú đơn hàng" rows="16"></textarea>
                                <input type="submit" value="Xác nhận" name="send_order" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
