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
                <a href="{{ URL::to('add-category-product') }}">
                    <button style="float:right;" type="button" class="btn btn-success">Thêm mới</button>
                </a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  <th style="width:20px;">
                    <label class="i-checks m-b-none">
                      <input type="checkbox"><i></i>
                    </label>
                  </th>
                  <th>Tên danh mục</th>
                  <th>Chế độ</th>
                  <th style="width:30px;"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $list as $rs )
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post"><i></i></label></td>
                    <td>{{ $rs->category_name }}</td>
                    <td><span class="text-ellipsis">
                        <?php
                        if($rs->category_status == 0){
                        ?>
                        <a href="{{ URL::to('/unactive-category/'.$rs->category_id) }}"><span class="fa-thumb-styling fa fa-thumbs-up" style="font-size: 28px;color:green;">Hiện</span></a>
                    <?php }else{ ?>
                        <a href="{{ URL::to('active-category/'.$rs->category_id) }}"><span class="fa-thumb-styling fa fa-thumbs-down" style="font-size: 28px;color:red;">Ẩn</span></a>
                    <?php
                        }
                    ?>
                    </span>
                    </td>
                    <td>
                        <a href="{{ URL::to('/edit-category-product',$rs->category_id) }}" class="active" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active">Sửa</i>
                        </a>
                        <a href="{{ URL::to('/delete-category',$rs->category_id) }}">
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
