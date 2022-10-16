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
        if($cartItems->isEmpty()){
            return redirect('/category')->with('status','Please add some products to your cart');
        }
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
            'payment_mode' => 'required',
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
        $order->transaction_id =  $request->input('transaction_id');
        $order->payment_mode = $request->input('payment_mode');
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
        if($request->input('payment_mode') == 'COD'){
            return redirect('/')->with('status','Order Placed Successfully');
        }else{
            return response()->json(['status'=>'success']);
        }
    }
    //proceed to pay 
    public function proceedToPay(Request $request){
        $user_id = Auth::id();
        $cartItems = Cart::where('user_id', $user_id)->get();
        $total_price = 0; 
        foreach ($cartItems as $cart) {
            $total_price += $cart->products->selling_price * $cart->prod_qty;
        }
        $firstname = $request->input('firstname'); 
        $lastname = $request->input('lastname'); 
        $email = $request->input('email'); 
        $phone = $request->input('phone'); 
        $address1 = $request->input('address1'); 
        $address2 = $request->input('address2'); 
        $city = $request->input('city'); 
        $state = $request->input('state'); 
        $country = $request->input('country'); 
        $pincode = $request->input('pincode'); 
        return response()->json([
            'user_id' =>  $user_id,
            'firstname'=> $firstname,
            'lastname'=> $lastname,
            'email'=> $email,
            'phone'=> $phone,
            'address1'=> $address1,
            'address2'=> $address2,
            'city'=> $city,
            'state'=> $state,
            'country'=> $country,
            'pincode'=> $pincode,
            'total_price' => $total_price,
        ]);
    }
}
