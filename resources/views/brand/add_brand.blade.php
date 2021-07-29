@extends('admin.admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        Thêm thương hiệu sản phẩm
        <a style="float:right;" href="{{ URL::to('list-brand') }}">
            <button type="button" class="btn btn-danger">Quay lại</button>
        </a>
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="{{ route('addbrand')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                    <input type="text" class="form-control" name="brand_name" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả thương hiệu</label>
                    <textarea name="brand_desc" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" id="exampleInputPassword1"  rows="8"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <textarea name="brand_slug" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" id="exampleInputPassword1"  rows="8"></textarea>
                </div>
                <div>
                    <label for="">Chế độ</label>
                    <select class="form-control input-sm m-bot15" name="brand_status">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-info">Đồng ý</button>
            </form>
        </div>

    </div>
</section>
@endsection
