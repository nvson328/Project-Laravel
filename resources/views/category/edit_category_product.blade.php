@extends('admin.admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        Sửa danh mục sản phẩm
        <a style="float:right;" href="{{ URL::to('list-category-product') }}">
            <button type="button" class="btn btn-danger">Quay lại</button>
        </a>
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" class="form-control" name="category_name" id="" value="{{ $list[0]->category_name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả danh mục</label><br>
                    <textarea name="category_desc" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" rows="8">{{ $list[0]->category_desc }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label><br>
                    <textarea name="category_slug" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" rows="8">{{ $list[0]->slug_category_product }}</textarea>
                </div>
                <div>
                    <label for="">Chế độ</label>
                    <select class="form-control input-sm m-bot15" name="category_status">
                        <option value="1">Ẩn</option>
                        <option value="0">Hiện</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-info">Đồng ý</button>
            </form>
        </div>

    </div>
</section>
@endsection
