@extends('layouts.front')
@section('title','My Cart')
@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}" class="anchor-style">Home</a>/<a href="{{url('/cart')}}" class="anchor-style">cart</a>
        </h6>
    </div>
</div>
<div class="container my-5">
    <div class="card shadow ">
        <div class="card-body">
            @if ($cartItems->isEmpty())
            <h5 class="fw-bold text-center my-4">Cart is empty</h5>
            <a href="/category" class="btn btn-secondary float-end sm">Continue Shoping</a>
            @else 
            @php
                $total = 0;
            @endphp   
            @foreach ($cartItems as $cart)
            <div class="row product_data">
                <div class="col-md-2">
                    <img 
                    src="{{asset('assets/uploads/products/'.$cart->products->image)}}"
                    height="70px"
                     alt="product_image">
                </div>
                <div class="col-md-5">
                    <h4>{{$cart->products->name}}</h4>
                    <small><span class="fw-bold">BDT</span> {{$cart->products->selling_price}}</small>
                </div>
                <div class="col-md-3 quantity">
                    <input type="hidden" class="prod_id"  value="{{ $cart->prod_id }}">
                    @if ($cart->products->qty >=$cart->prod_qty)
                    <label for="Quantity">Quantity</label>
                    <div class="input-group text-center mb-3" style="width:  130px">
                           
                                <button class="input-group-text decrement-btn changeQuantity" style="cursor: pointer"
                                >
                                    -
                                </button>
                            <input type="text" name="quantity"
                            value="{{ $cart->prod_qty }}" 
                            class="form-control qty-input text-center"
                            >
                                <button 
                                style="cursor: pointer" class="input-group-text increment-btn changeQuantity">
                                    +
                                </button>
                            
                        </div>
                        @php
                        $total += $cart->products->selling_price* $cart->prod_qty;
                    @endphp
                        @else
                        <p class="badge bg-danger">Out of stock</p>
                        
                    @endif
                    
                </div>
                <div style="cursor: pointer" class="col-md-2 text-danger">
                    <button class=" btn btn-danger 
                    btn-sm
                    delete-cart-item"><i class="fa-solid fa-trash"></i> Remove</button>
                </div>
            </div>
           
        @endforeach
            @endif
        </div>
        @if (!$cartItems->isEmpty())
        <div class="card-footer">
            <h6 style="display: inline"><b>Total Price BDT</b>    <i>  {{$total}}</i></h6>
            <a href="{{url('cart/checkout')}}" class="btn btn-success float-end">Proced To Checkout</a>
           
         </div>
        @endif
      
    </div>
</div>

@endsection