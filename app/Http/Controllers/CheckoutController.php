<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Auth;
use Session;
session_start();
class CheckoutController extends Controller
{
    //đăng nhập trước khi thanh toán
    public function LoginCheckout(){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $product = Product::all();
        return view('pages.checkout.login_checkout',compact('category','brand','product'));
    }
    //đăng kí khách hàng
    public function AddCustomer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->name);
        return redirect()->to('checkout');
    }
    // Trang Thanh toán
    public function Checkout(){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $product = Product::all();
        return view('pages.checkout.checkout',compact('category','brand','product'));
    }
    //Lưu đơn hàng
    public function SaveCheckout(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return redirect()->to('payment');
    }
    //Thanh toán
    public function Payment(){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $product = Product::all();
        return view('pages.checkout.payment',compact('category','brand','product'));
    }
    //Đăng xuất
    public function LogoutCheckout(){
        Session::flush();
        return redirect()->to('login-checkout');
    }

    //Check đăng nhập
    public function LoginCustomer(Request $request){
        $email = $request->customer_email;
        $password = md5($request->customer_password);
        $rs = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($rs){
            Session::put('customer_id',$rs->customer_id);
            return redirect()->to('checkout');
        }else{
            return redirect()->to('login-checkout');
        }

            // $arr=[
            //     'customer_email' => $request->customer_email,
            //     'customer_password' => md5($request->customer_password),
            // ];
            // if (Auth::attempt($arr)) {
            //     return redirect()->to('checkout');
            // }
            // else{
            //     return redirect()->to('login-checkout');
            // }
    }

}
