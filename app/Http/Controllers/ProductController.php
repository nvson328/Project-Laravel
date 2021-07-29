<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
class ProductController extends Controller
{
    public function ListProduct(){
        $list = Product::all();
        return view('product.list_product',compact('list'));
    }
    public function FormProduct(){
        $cate = Category::all();
        $brand = Brand::all();
        return view('product.add_product',compact('cate','brand'));
    }
    public function UnactiveProduct($id){
        Product::where('product_id',$id)->update(['product_status' => 1]);
        return redirect()->to('list-product');
    }
    public function ActiveProduct($id){
        Product::query()->where('product_id',$id)->update(['product_status' => 0]);
        return redirect()->to('list-product');
    }
    public function AddProduct(Request $request){
        $prod = new Product();
        $prod->product_name = $request->input('product_name');
        $prod->product_price = $request->input('product_price');
        $prod->product_desc = $request->input('product_desc');
        $prod->product_slug = $request->input('product_slug');
        $prod->category_id = $request->input('product_cate');
        $prod->brand_id = $request->input('product_brand');
        $prod->product_status = $request->input('product_status');
        $prod->product_image = $request->file('product_image');

        if($prod->product_image)
        {
            $get_name_image = $prod->product_image->getClientOriginalName();
            $new_image = $get_name_image.rand(0,99).'.'.$prod->product_image->getClientOriginalExtension();
            $prod->product_image->move('public/uploads/product',$new_image);
            $prod->product_image = $new_image;
            $prod->save();
            return redirect()->to('list-product')->with('message','Thêm sản phẩm thành công!');
        }
        $prod->product_image = '';
        $prod->save();
        return redirect()->to('list-product')->with('message','Thêm sản phẩm thành công!');
    }
    public function FormEditProduct($id){
        $cate = Category::all();
        $brand = Brand::all();
        $list =  Product::where('product_id',$id)->get();
        return view('product.edit_product',compact('list','cate','brand'));
    }
    public function EditProduct(Request $request, $id){
        $data = array();
        $data['product_name'] = $request->input('product_name');
        $data['product_price'] = $request->input('product_price');
        $data['product_slug'] = $request->input('product_slug');
        $data['product_desc'] = $request->input('product_desc');
        $data['category_id'] = $request->input('product_cate');
        $data['brand_id'] = $request->input('product_brand');
        $data['product_status'] = $request->input('product_status');
        $get_image = $request->file('product_image');

        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $new_image = $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$id)->update($data);
            return redirect()->to('list-product')->with('message','Cập nhật sản phẩm thành công!');
        }
        DB::table('tbl_product')->where('product_id',$id)->update($data);
        return redirect()->to('list-product')->with('message','Cập nhật sản phẩm thành công!');
    }
    public function DeleteProduct($id)
    {
        Product::where('product_id', $id)->delete();
        return redirect()->back();
    }
    //End Function Admin Page

    public function DetailsProduct($id){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $details_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$id)->get();

        foreach($details_product as $rs){
            $category_id = $rs->category_id;
        }
        // dd($category_id);
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$id])->get();
        // dd($related_product);
        return view('pages.product.details_product',compact('category','brand','details_product','related_product'));
    }
}
