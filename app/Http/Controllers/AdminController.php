<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.admin_content');
    }
    public function login(){
        return view('admin.admin_login');
    }
    public function CheckLogin( Request $request)
    {
        $arr=[
            'admin_email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($arr)) {
            dd('Đăng nhập thành công');
        }
        else{
            dd('đăng nhập thất bại');
        }
    }

}
