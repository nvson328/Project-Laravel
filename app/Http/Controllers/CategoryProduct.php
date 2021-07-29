<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class CategoryProduct extends Controller
{
    public function ListCategory(){
        $list = Category::all();
        return view('category.list_category_product',compact('list'));
    }
    public function UnactiveCategory($id){
        Category::where('category_id',$id)->update(['category_status' => 1]);
        return redirect()->to('list-category-product');
    }
    public function ActiveCategory($id){
        Category::query()->where('category_id',$id)->update(['category_status' => 0]);
        return redirect()->to('list-category-product');
    }
    public function FormCategory(){

        return view('category.add_category_product');
    }
    public function AddCategory(Request $request){
        $cate = new Category();
        $cate->category_name = $request->input('category_name');
        $cate->category_desc = $request->input('category_desc');
        $cate->category_status = $request->input('category_status');
        $cate->save();
        return redirect()->to('list-category-product')->with('message','Tạo danh mục thành công!');
    }
    public function FormEditCategory($id){
        $list =  Category::where('category_id',$id)->get();

        return view('category.edit_category_product',compact('list'));
    }
    public function EditCategory(Request $request, $id){
        $category_name = $request->input('category_name');
        $category_desc = $request->input('category_desc');
        $slug_category_product = $request->input('category_slug');
        $category_status = $request->input('category_status');
        Category::where('category_id',$id)->update([
            'category_name' => $category_name,
            'slug_category_product' => $slug_category_product,
            'category_desc' => $category_desc,
            'category_status' => $category_status,
        ]);
        return redirect()->to('list-category-product')->withInput();
    }
    public function DeleteCategory($id){
        Category::where('category_id',$id)->delete();
        return redirect()->back();
    }
    //End Function AdminPage

    //Start Function FE
    public function ListCategoryProduct($id){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $category_by_id = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_product.category_id',$id)->where('tbl_product.product_status',0)->get();
        $category_name = Category::where('tbl_category_product.category_id',$id)->limit(1)->get();
        return view('pages.category.list_category_product',compact('category','brand','category_by_id','category_name'));
    }

}
