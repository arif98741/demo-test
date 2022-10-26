<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminFrontendController extends Controller
{
    public function index(){
        $users = User::all()->count();
        $products = Product::all()->count();
        $categories = Category::all()->count();
        return view('admin.index',compact('users','products','categories'));
    }
}
