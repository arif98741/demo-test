@extends('layouts.front')
@section('title','My order')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
           <div class="card-header bg-primary text-white py-3">
            <h5>  My Orders <a href="{{url('my-orders')}}" class="btn btn-secondary float-end">Back</a></h5>
            
           </div>
           <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold">Shipping Details</h4>
                    <hr>
                   <label for="">First Name</label>
                   <div class="border p-2">{{$orders->fname}}</div>
                   <label for="">Last Name</label>
                   <div class="border p-2">{{$orders->lname}}</div>
                   <label for="">Email</label>
                   <div class="border p-2">{{$orders->email}}</div>
                   <label for="">Contact No.</label>
                   <div class="border p-2">{{$orders->phone}}</div>
                   <label for="">Shiping Address</label>
                   <div class="border p-2">
                    
                    {{$orders->address1}}
                    {{$orders->address2}}
                    {{$orders->city}}
                    {{$orders->state}}
                    {{$orders->country}}
                    </div>
                    <label for="">Zip Code</label>
                    <div class="border p-2">{{$orders->pincode}}</div>
                   
            </div>
                <div class="col-md-6">
                    <h4 class="fw-bold">Order Details</h4>
                    <hr>
                    @if ($orders->payment_mode == 'COD')
                    <p class="fw-bold">{{$orders->payment_mode}}</p>
                        @else
                        <small>Paid By <b>{{$orders->payment_mode}}</b></small>
                        <br>
                        <small>Transaction Id : <b>{{$orders->transaction_id}}</b></small>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders->orderItems as $order)
                                <tr>
                                    <td>{{$order->products->name}}</td>
                                    <td>{{$order->qty}}</td>
                                    <td>{{$order->price}}</td>
                                    <td><img src="{{asset('assets/uploads/products/'.$order->products->image)}}" height="50px" width="70px" alt="product image"></td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                        <p>Grand total <span class="float-end"> <b>BDT</b>{{$orders->total_price}}</span></p>
                 
                    
                    
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
@endsection