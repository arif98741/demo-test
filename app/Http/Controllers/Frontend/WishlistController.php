<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlists = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlists'));
    }
    public function add(Request $request){
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
           if(Product::find($prod_id)){
            if(Wishlist::where('user_id',Auth::id())->where('prod_id',$prod_id)->exists()){
                return response()->json(['status'=>'Already exists in wishlist']);
            }else{
                $wishlist = new Wishlist();
                $wishlist->prod_id = $prod_id;
                $wishlist->user_id = Auth::id();
                $wishlist->save();
                return response()->json(['status'=>'Added to wishlist']);
            }
           }else{
            return response()->json(['status'=>'Product does not exist']);
           }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }
    }
    public function deleteItem(Request $request){
        $prod_id = $request->input('prod_id');
        if(Auth::check()){
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $wishlist = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $wishlist->delete();
                return response()->json(['status'=>'Item removed from wishlist']);
            }else{
                return response()->json(['status'=>'Item does not exists']);
            }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }
    }
    public function wishlistcount(){
        $wishlistcount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['wishlistcount'=>$wishlistcount]);
    }
}
