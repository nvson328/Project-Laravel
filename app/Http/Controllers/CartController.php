<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;
session_start();
class CartController extends Controller
{
    public function SaveCart(Request $request){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $product = Product::all();
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;
        $data_cart = Product::where('product_id',$product_id)->get();
        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['name'] = $data_cart[0]->product_name;
        $data['price'] = $data_cart[0]->product_price;
        $data['weight'] = '123';
        $data['options']['image']= $data_cart[0]->product_image;
        Cart::add($data);
        return redirect()->to('/show-cart');
        // Cart::destroy();
    }


        //Function dùng package Shopping Cart
        public function ShowCart(){
            $category = Category::where('category_status',0)->get();
            $brand = Brand::where('brand_status',0)->get();
            $product = Product::all();
            return view('pages.cart.show_cart',compact('category','brand','product'));
        }//End Function

        public function DeleteCart($rowId){
            Cart::update($rowId,0);
            return redirect()->to('/show-cart');
        }
        public function UpdateQty(Request $request){
            $rowId = $request->row_id;
            $qty = $request->cart_quantity;
            Cart::update($rowId,$qty);
            return redirect()->to('/show-cart');
        }
        //Funtion dùng ajax
        public function gio_hang(Request $request){
            //seo
            $meta_desc = "Giỏ hàng của bạn";
            $meta_keywords = "Giỏ hàng Ajax";
            $meta_title = "Giỏ hàng Ajax";
            $url_canonical = $request->url();
            //--seo
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
            return view('pages.cart.show_cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
        }
        public function add_cart_ajax(Request $request){
            $data = $request->all();
            $session_id = substr(md5(microtime()),rand(0,26),5);
            $cart = Session::get('cart');
            if($cart == true){
                $is_avaiable = 0;
                foreach($cart as $val){
                    if($val['product_id'] == $data['cart_product_id']){
                        $is_avaiable++;
                    }
                }
                if($is_avaiable == 0){
                    $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                    );
                    Session::put('cart',$cart);
                }
            }else{
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
            Session::save();
        }
        public function DeleteCartAjax($session_id){
            $cart = Session::get('cart');
            if($cart == true){
                foreach($cart as $key => $rs){
                    if($rs['session_id'] == $session_id){
                        unset($cart[$key]);//Nếu $key = 2 và hệ thống kiểm tra session_id ở vị trí thứ 2 = với $id cart thứ 2 thì sẽ unset cart ở vị trí thứ 2

                    }
                }
                Session::put('cart',$cart);
                return redirect()->back()->with('message','Xoá sản phẩm thành công');
            }
        }
        public function UpdateCartAjax(Request $request){
            $data = $request->all();
            $cart = Session::get('cart');

            if( $cart == true){
                foreach($data['cart_qty'] as $key => $qty){
                    foreach($cart as $session => $val){
                        if($val['session_id'] == $key){
                            $cart[$session]['product_qty'] = $qty;

                        }
                    }
                }
                Session::put('cart',$cart);

                return redirect()->back()->with('message','Cập nhật giỏ hàng thành công');
            }
            else{
                return redirect()->back()->with('message','Cập nhật giỏ hàng không thành công');
            }

        }

}
