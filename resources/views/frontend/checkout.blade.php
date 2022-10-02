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
                                <input type="text" class="form-control" name="fname"
                                value="{{Auth::user()->name}}"
                                placeholder="Enter first name"
                                required
                                >
                            </div>
                            <!---last name--->
                            <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <br>
                                <input type="text" class="form-control" name="lname" id=""
                                value="{{Auth::user()->lname}}"
                                placeholder="Enter last name"
                                required>
                            </div>
                            <!---email--->
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <br>
                                <input type="email" class="form-control" name="email"
                                value="{{Auth::user()->email}}"
                                placeholder="Enter email"
                                required
                                >
                            </div>
                            <!---phone--->
                            <div class="col-md-6">
                                <label for="phonenumber">Phone Number</label>
                                <br>
                                <input type="number" class="form-control" name="phone"
                                value="{{Auth::user()->phone}}"
                                placeholder="Enter phone number"
                                required
                                >
                            </div>
                            <!---address 1--->
                            <div class="col-md-6">
                                <label for="address1">Address 1</label>
                                <br>
                                <input type="text" class="form-control" name="address1"
                                value="{{Auth::user()->address1}}"
                                placeholder="Enter Address 1"
                                required >
                            </div>
                            <!---address 2--->
                            <div class="col-md-6">
                                <label for="address2">Address 2</label>
                                <br>
                                <input type="text" class="form-control" name="address2"
                                value="{{Auth::user()->address2}}"
                                placeholder="Enter Address 2"
                                required>
                            </div>
                            <!---city--->
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <br>
                                <input type="text" class="form-control" name="city"
                                value="{{Auth::user()->city}}"
                                placeholder="Enter city"
                                required>
                            </div>
                            <!---state--->
                            <div class="col-md-6">
                                <label for="state">State</label>
                                <br>
                                <input type="text" class="form-control" name="state"
                                value="{{Auth::user()->state}}"
                                placeholder="Enter state"
                                required>
                            </div>
                            <!---country--->
                            <div class="col-md-6">
                                <label for="country">Country</label>
                                <br>
                                <input type="text" class="form-control" name="country"
                                value="{{Auth::user()->country}}"
                                placeholder="Enter country"
                                >
                            </div>
                            <!---pin code--->
                            <div class="col-md-6">
                                <label for="state">Pin code</label>
                                <br>
                                <input type="text" class="form-control" name="pincode"
                                value="{{Auth::user()->pincode}}"
                                placeholder="Enter pin code"
                                >
                            </div>
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
                        <h6 class="my-3"><span class="fw-bold ">Total BDT </span> {{$total}}</h6>
                        <button class="w-100 btn btn-primary float-end">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection