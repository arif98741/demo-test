<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $prod_id= $request->input('prod_id');
        $prod_qty= $request->input('prod_qty');
        if(Auth::check()){
            $prod_check = Product::where('id',$prod_id)->first();
            if($prod_check){
                if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['status'=>$prod_check->name.'  Already added to cart']);
                }else{
                $cartItem = new Cart();
                $cartItem->user_id = Auth::id();
                $cartItem->prod_id = $prod_id;
                $cartItem->prod_qty = $prod_qty;
                $cartItem->save();
                return response()->json(['status' => $prod_check->name.' Added to cart']);
                }
            }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }
        return response()->json(['success']);
    }
    public function viewCart(){
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartItems'));
    }
    public function deleteProduct(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cart_item = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart_item->delete();
                return response()->json(['status'=>'Product Deleted Successfully']);
            }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }
    }
    public function updateQuantity(Request $request){
        $prod_id = $request->input('prod_id');
        $qty = $request->input('qty');
        if(Auth::check()){
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();

                $cart->prod_qty = $qty;
                $cart->update();
                return response()->json(['status'=>'Quantity Updated']);
            }
            return response()->json(['status'=>'prodId'.$prod_id.'qty'.$qty]);
        }
        else{
            return response()->json(['status','Login to continue']);
        }
    }
    public function cartcount(){
        $cartcount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['cartcount'=>$cartcount]);
    }
}
