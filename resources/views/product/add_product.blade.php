@extends('admin.admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        Thêm danh mục sản phẩm
        <a style="float:right;" href="{{ URL::to('list-product') }}">
            <button type="button" class="btn btn-danger">Quay lại</button>
        </a>
    </header>
    <div class="panel-body">
        <div class="position-center">
            <form role="form" action="{{ route('addproduct')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="product_name" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá</label>
                    <input type="number" class="form-control" name="product_price" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hình ảnh</label>
                    <input type="file" class="form-control" name="product_image" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả sản phẩm</label><br>
                    <textarea name="product_desc" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" id="exampleInputPassword1"  rows="8"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label><br>
                    <textarea name="product_slug" style="resize: none; width:970px;border: 1px solid #ccc;border-radius:5px;" id="exampleInputPassword1"  rows="8"></textarea>
                </div>
                <div>
                    <label for="">Danh mục</label>
                    <select class="form-control input-sm m-bot15" name="product_cate">
                        @foreach($cate as $rs)
                            <option value="{{ $rs->category_id }}">{{ $rs->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Thương hiệu</label>
                    <select class="form-control input-sm m-bot15" name="product_brand">
                        @foreach($brand as $rs)
                            <option value="{{ $rs->brand_id }}">{{ $rs->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Chế độ</label>
                    <select class="form-control input-sm m-bot15" name="product_status">
                        <option value="0">Hiện</option>
                        <option value="1">Ẩn</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-info">Đồng ý</button>
            </form>
        </div>

    </div>
</section>
@endsection
