<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        // $old_cartItems = Cart::where('user_id',Auth::id())->get();
        // foreach ($old_cartItems as $cart) {
        //     if(!Product::where('id',$cart->prod_id)->where('qty','==',$cart->prod_qty)->exists()){
        //         $removeItem = Cart::where('user_id',Auth::id())->where('prod_id',$cart->prod_id)->first();
        //         $removeItem->delete();
        //     }
        // }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartItems'));
    }
    public function placeorder(Request $request){
        $random = rand(1111,9999);
        $validate = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        //calculate the total price 
        $total = 0;
        $cart_items = Cart::where('user_id',Auth::id())->get();
        foreach ($cart_items as $cart) {
            $total += $cart->products->selling_price * $cart->prod_qty;
        }
        $order->total_price = $total;
        $order->tracking_no = rand(1111,9999);
        $order->save();
        //cart to orderItem 
        $cartItems = Cart::where('user_id',Auth::id())->get();
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $cart->prod_id,
                'qty' => $cart->prod_qty,
                'price'=> $cart->products->selling_price,
            ]);
            $prod = Product::where('id',$cart->prod_id)->first();
            $prod->qty = $prod->qty - $cart->prod_qty;
            $prod->update();
        }
        //store address to user table
        if(Auth::user()->address1 == NULL){
            $user = User::where('id',Auth::id())->first();
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        // clear cart
        Cart::destroy($cartItems);
        return redirect('/')->with('status','Order Placed Successfully');

    }
}
