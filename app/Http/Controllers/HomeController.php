<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
session_start();
class HomeController extends Controller
{
    public function index(){
        $category = Category::where('category_status',0)->get();
        $brand = Brand::where('brand_status',0)->get();
        $product = Product::all();
        return view('pages.home',compact('category','brand','product'));
    }

}
