@extends('admin.admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        Thêm danh mục sản phẩm
        <a style="float:right;" href="{{ URL::to('list-category-product') }}">
            <button type="button" class="btn btn-danger">Quay lại</button>
        </a>
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="{{ route('addcategory')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" class="form-control" name="category_name" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả danh mục</label><br>
                    <textarea name="category_desc" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" id="exampleInputPassword1"  rows="8"></textarea>
                </div>
                <div>
                    <label for="">Chế độ</label>
                    <select class="form-control input-sm m-bot15" name="category_status">
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
