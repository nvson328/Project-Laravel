<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class BrandController extends Controller
{
    public function ListBrand(){
        $list = Brand::all();
        return view('brand.list_brand',compact('list'));
    }
    public function UnactiveBrand($id){
        Brand::where('brand_id',$id)->update(['brand_status' => 1]);
        return redirect()->to('list-brand-product');
    }
    public function ActiveBrand($id){
        Brand::query()->where('brand_id',$id)->update(['brand_status' => 0]);
        return redirect()->to('list-brand');
    }
    public function FormBrand(){

        return view('brand.add_brand');
    }
    public function AddBrand(Request $request){
        $brand = new Brand();
        $brand->brand_name = $request->input('brand_name');
        $brand->brand_desc = $request->input('brand_desc');
        $brand->brand_slug = $request->input('brand_slug');
        $brand->brand_status = $request->input('brand_status');
        $brand->save();
        return redirect()->to('list-brand')->with('message','Tạo danh mục thành công!');
    }
    public function FormEditBrand($id){
        $list =  Brand::where('brand_id',$id)->get();

        return view('brand.edit_brand',compact('list'));
    }
    public function EditBrand(Request $request, $id){
        $brand_name = $request->input('brand_name');
        $brand_desc = $request->input('brand_desc');
        $brand_slug = $request->input('brand_slug');
        $brand_status = $request->input('brand_status');
        Brand::where('brand_id',$id)->update([
            'brand_name' => $brand_name,
            'brand_desc' => $brand_desc,
            'brand_slug' => $brand_slug,
            'brand_status' => $brand_status,
        ]);
        return redirect()->to('list-brand')->withInput();
    }
    public function DeleteBrand($id){
        Brand::where('brand_id',$id)->delete();
        return redirect()->back();
    }
    public function ListBrandProduct($id){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $brand_by_id = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.brand_id',$id)->where('tbl_product.product_status',0)->get();
        $brand_name = Brand::where('tbl_brand.brand_id',$id)->limit(1)->get();
        return view('pages.brand.list_brand_product',compact('category','brand','brand_by_id','brand_name'));
    }

}
