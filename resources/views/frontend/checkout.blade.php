@extends('layouts.front')
@section('title','My Cart')
@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}" class="anchor-style">Home</a>/
            <a href="{{url('/cart')}}" class="anchor-style">cart</a>/
            <a href="{{url('cart/checkout')}}" class="anchor-style">checkout</a>
        </h6>
    </div>
</div>
<div class="container mt-5">
    <form action="{{url('/place-order')}}" method="POST">
        @csrf
        <div class="row my-5">
          <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3>Basic Details</h3>
                        <hr>
                        <div class="row checkout-form">
                            <!---first name--->
                            <div class="col-md-6">
                                <label for="firstname">First Name</label>
                                <br>
                                <input type="text" class="form-control firstname" name="fname"
                                value="{{Auth::user()->name}}"
                                placeholder="Enter first name"
                                required
                                >
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <!---last name--->
                            <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <br>
                                <input type="text" class="form-control lastname" name="lname" id=""
                                value="{{Auth::user()->lname}}"
                                placeholder="Enter last name"
                                required>
                                <span id="lname_error" class="text-danger"></span>
                            </div>
                            <!---email--->
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <br>
                                <input type="email" class="form-control email" name="email"
                                value="{{Auth::user()->email}}"
                                placeholder="Enter email"
                                required
                                >
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <!---phone--->
                            <div class="col-md-6">
                                <label for="phonenumber">Phone Number</label>
                                <br>
                                <input type="number" class="form-control phone" name="phone"
                                value="{{Auth::user()->phone}}"
                                placeholder="Enter phone number"
                                required
                                >
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <!---address 1--->
                            <div class="col-md-6">
                                <label for="address1">Address 1</label>
                                <br>
                                <input type="text" class="form-control address1" name="address1"
                                value="{{Auth::user()->address1}}"
                                placeholder="Enter Address 1"
                                required >
                                <span id="address1_error" class="text-danger"></span>
                            </div>
                            <!---address 2--->
                            <div class="col-md-6">
                                <label for="address2">Address 2</label>
                                <br>
                                <input type="text" class="form-control address2" name="address2"
                                value="{{Auth::user()->address2}}"
                                placeholder="Enter Address 2"
                                required>
                                <span id="address2_error" class="text-danger"></span>
                            </div>
                            <!---city--->
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <br>
                                <input type="text" class="form-control city" name="city"
                                value="{{Auth::user()->city}}"
                                placeholder="Enter city"
                                required>
                                <span id="city_error" class="text-danger"></span>
                            </div>
                            <!---state--->
                            <div class="col-md-6">
                                <label for="state">State</label>
                                <br>
                                <input type="text" class="form-control state" name="state"
                                value="{{Auth::user()->state}}"
                                placeholder="Enter state"
                                required>
                                <span id="state_error" class="text-danger"></span>
                            </div>
                            <!---country--->
                            <div class="col-md-6">
                                <label for="country">Country</label>
                                <br>
                                <input type="text" class="form-control country" name="country"
                                value="{{Auth::user()->country}}"
                                placeholder="Enter country"
                                >
                                <span id="country_error" class="text-danger"></span>
                            </div>
                            <!---pin code--->
                            <div class="col-md-6">
                                <label for="state">Pin code</label>
                                <br>
                                <input type="text" class="form-control pincode" name="pincode"
                                value="{{Auth::user()->pincode}}"
                                placeholder="Enter pin code"
                                >
                                <span id="pincode_error" class="text-danger"></span>
                            </div>
                            <input type="hidden" name="payment_mode" value="COD">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Details</h6>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cartItems as $cart)
                                    <tr>
                                        <td>
                                            <img height="30px" width="40px" src="{{asset('assets/uploads/products/'.$cart->products->image)}}" alt="">
                                        </td>
                                        <td>{{$cart->products->name}}</td>
                                        <td>{{$cart->prod_qty}}</td>
                                        <td>
                                           <span class="fw-bold"> BDT</span>
                                           
                                           {{$cart->products->selling_price}}</td>
                                    </tr>
                                    @php
                                        $total += $cart->products->selling_price * $cart->prod_qty 
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <h6 class="my-3"><span class="fw-bold ">Total BDT </span>
                        <span class="total">{{$total}}</span></h6>
                        <button type="submit" class="w-100 btn btn-success float-end">Place Order || COD</button>

                        <button type="button" class="w-100 btn btn-primary my-3 sslcommerz-btn">
                            <img width="80%" height="50%" src="{{asset('/assets/images/ssl-image.jpg')}}" alt="">
                        </button>
                        <div class="paypal-btn">
                           
                        </div>
                        <div id="paypal-button-container"></div>
                      
                    </div>
                </div>
            </div>
        </div>
    </form>
   
</div>
@endsection
@section('scripts')
//
<script src="https://www.paypal.com/sdk/js?client-id=AQUtYowPyELMMjv_x64cIZYzS_X8CDwN-Az-1JoeRoRsQeLuTpFquBk17ixKnhqJvOw-rtHCwLHweWT4&currency=USD&intent=capture&enable-funding=venmo"
data-sdk-integration-source="integrationbuilder"></script>
<script>
    
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
    //paypal script 


    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{round($total / 90, 2)}}'// Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            var firstname = $('.firstname').val();
            var lastname  = $('.lastname').val();
            var email     = $('.email').val();
            var phone     = $('.phone').val();
            var address1  = $('.address1').val();
            var address2  = $('.address2').val();
            var city      = $('.city').val();
            var state     = $('.state').val();
            var country   = $('.country').val();
            var pincode   = $('.pincode').val();
            var info = {
                    'user_id': '{{Auth::user()->id}}',
                    'fname':firstname,
                    'lname':lastname,
                    'email':email,
                    'phone':phone,
                    'address1':address1,
                    'address2':address2,
                    'city':city,
                    'state':state,
                    'country':country,
                    'pincode':pincode,
                    'total_price': '$'+'{{round($total / 90, 2)}}',
                    'transaction_id':orderData.purchase_units[0].payments.captures[0].id,
                    'payment_mode':'PayPal'
                }
            $.ajax({
                type: "POST",
                url: "/place-order",
                data: info,
                success: function (response) {
                    if(response.status == 'success'){
                        window.location.href = '/';
                    } 
                }
            });
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');


</script>    
@endsection