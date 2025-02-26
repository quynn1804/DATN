<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('user.home', compact('products'));
    }

    public function pageCategory(){
        $products = Product::all();
        return view('user.pageCategory', compact('products'));
    }

    public function login(){
        return view('user.login');
    }

    public function cart(){
        return view('user.cart');
    }

    public function about(){
        return view('user.about');
    }

    public function contact(){
        return view('user.contact');
    }

    public function myAccount(){
        return view('user.myAccount');
    }

    public function shopLeftSidebar(){
        return view('user.shopLeftSidebar');
    }

    public function singleProduct(){
        return view('user.singleProduct');
    }
}
