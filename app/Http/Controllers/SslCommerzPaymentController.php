<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SslCommerzPaymentController extends Controller
{
    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                // 'name' => $post_data['cus_name'],
                'user_id'=>'3',
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                // 'amount' => $post_data['total_amount'],
                // 'status' => 'Pending',
                // 'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                // 'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

       
        $post_data = array();
        $post_data['total_amount'] = $request->input('total_price'); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->input('fname');
        $post_data['cus_email'] = $request->input('lname');
        $post_data['cus_add1'] = $request->input('address1');
        $post_data['cus_add2'] = $request->input('address2');
        $post_data['cus_city'] = $request->input('city');
        $post_data['cus_state'] = $request->input('state');
        $post_data['cus_postcode'] = $request->input('pincode');
        $post_data['cus_country'] = $request->input('country');
        $post_data['cus_phone'] = $request->input('phone');
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $request->input('fname');
        $post_data['ship_add1'] = $request->input('address1');
        $post_data['ship_add2'] = $request->input('address2');
        $post_data['ship_city'] =$request->input('city');
        $post_data['ship_state'] = $request->input('state');
        $post_data['ship_postcode'] = $request->input('pincode');
        $post_data['ship_phone'] = $request->input('phone');
        $post_data['ship_country'] = $request->input('country');

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $order = new Order();
        $order['user_id'] = $request->input('user_id');
        $order['fname'] = $request->input('fname');
        $order['lname'] = $request->input('lname');
        $order['email'] = $request->input('email');
        $order['phone'] = $request->input('phone');
        $order['address1'] = $request->input('address1');
        $order['address2'] = $request->input('address2');
        $order['city'] = $request->input('city');
        $order['state'] = $request->input('state');
        $order['country'] = $request->input('country');
        $order['pincode'] = $request->input('pincode');
        $order['tracking_no'] = rand(1111,9999);
        $order['total_price'] =$request->input('total_price');
        $order['transaction_id'] =$post_data['tran_id'];
        $order['payment_mode'] =$request->input('payment_mode');
        $order['currency'] = $post_data['currency'];
        $order->save();
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->insert([
        //         'user_id' => $request->input('user_id'),
        //         'fname' =>$request->input('fname'),
        //         'lname' => $request->input('lname'),
        //         'email' => $request->input('email'),
        //         'phone' => $request->input('phone'), 
        //         'address1' => $request->input('address1'),
        //         'address2' => $request->input('address2'),
        //         'city' => $request->input('city'),
        //         'state' => $request->input('state'),
        //         'country' => $request->input('country'),
        //         'pincode' => $request->input('pincode'),
        //         'tracking_no' => rand(1111,9999),
        //         'total_price' => $request->input('total_price'),
        //         'transaction_id' => $post_data['tran_id'],
        //         'payment_mode' => $request->input('payment_mode'),
               
        //         'currency' => $post_data['currency'],
                
        //     ]);
         
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
         
        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
        return redirect('/');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
