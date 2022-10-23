<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class frontendController extends Controller
{
    public function index(){
        $featured_products = Product::where('trending','1')->take(15)->get();
        $trending_category = Category::where('popular','1')->get();
        $slider = Slider::all();
        return view('frontend.index',compact('featured_products','trending_category','slider'));
    }
    public function category(){
        $category = Category::where('status','0')->get();
        return view('frontend.category',compact('category'));
    }
    public function viewCategory($slug){
        if(Category::where('slug',$slug)->exists()){
            $category = Category::where('slug',$slug)->first();
            $products = Product::where('cate_id',$category->id)->where('status','0')->get();
            return view('frontend.products.index',compact('category','products'));
        }else{
            return redirect('/')->with('status','Catgory Does Not Exists');
        }
    }
    public function productView($cate_slug,$prod_slug){
        if(Category::where('slug',$cate_slug)->exists()){
            if(Product::where('slug',$prod_slug)->exists()){
                $product = Product::where('slug',$prod_slug)->first();
                $ratings = Rating::where('prod_id',$product->id)->get();
                $rating_sum = Rating::where('prod_id',$product->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id',$product->id)->where('user_id',Auth::id())->first();
                $review = Review::where('prod_id',$product->id)->get();
                if($ratings->count() > 0){
                     $rating_value = $rating_sum / $ratings->count();
                }else{
                    $rating_value = 0;
                }
                return view('frontend.products.view',compact('product','ratings','rating_value','user_rating','review'));
            }else{
                return redirect('/')->with('status','This link was broken');
            }
        }else{
            return redirect('/')->with('status','No such category found');
        }
    }
    public function productlistAjx(){
        $products = Product::select('name')->where('status','0')->get();
        $data = [];
        foreach ($products as $item) {
           $data[] = $item['name'];
        }
        return $data;
    }
    public function searchProduct(Request $request){
        $searched_product = $request->product_name;
        if($searched_product != ''){
            $product = Product::where("name","LIKE","%$searched_product%")->first();
            if($product){
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }else{
                return redirect()->back()->with('status','No product matched in your search');
            }

        }else{
            return redirect()->back();
        }
    }
}
