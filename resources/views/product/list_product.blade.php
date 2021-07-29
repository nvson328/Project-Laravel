@extends('admin.admin_layout')
@section('admin_content')
<section class="panel">
    <div class="table-agile-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            Danh sách danh mục
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
          <div class="row w3-res-tb">
            <div class="col-md-12" >
                <a href="{{ URL::to('add-product') }}">
                    <button style="float:right;" type="button" class="btn btn-success">Thêm mới</button>
                </a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  <th>Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th>Giá tiền</th>
                  <th style="width:35%;">Mô tả</th>
                  <th>Chế độ</th>
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $list as $rs )
                <tr>
                    <td> <img src="public/uploads/product/{{ $rs->product_image }}" width="100" height="100" alt=""></td>
                    <td>{{ $rs->product_name }}</td>
                    <td>{{ number_format($rs->product_price).'vnđ' }}</td>
                    <td>{{ $rs->product_desc }}</td>
                    <td><span class="text-ellipsis">
                        <?php
                        if($rs->product_status == 0){
                        ?>
                        <a href="{{ URL::to('/unactive-product/'.$rs->product_id) }}"><span class="fa-thumb-styling fa fa-thumbs-up" style="font-size: 28px;color:green;">Hiện</span></a>
                    <?php }else{ ?>
                        <a href="{{ URL::to('active-product/'.$rs->product_id) }}"><span class="fa-thumb-styling fa fa-thumbs-down" style="font-size: 28px;color:red;">Ẩn</span></a>
                    <?php
                        }
                    ?>
                    </span>
                    </td>
                    <td>
                        <a href="{{ URL::to('/edit-product',$rs->product_id) }}" class="active" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
                        </a>
                        <a  href="{{ route('delete', ['id' => $rs->product_id]) }}">
                            <i class="fa fa-times text-danger text" style="margin-top: 10px;">Xoá</i>
                        </a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
</section>
@endsection
