@extends('layouts.admin')
@section('title','Order history')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
           <div class="card-header bg-primary text-white py-3">
            <h5>Order history <a href="{{url('orders')}}" class="btn btn-secondary float-end">New Orders</a></h5>
            
           </div>
           <div class="card-body">
            @if ($orders->isEmpty())
            <h4 class="text-center my-5">No orders History</h4>
            @else
            @foreach ($orders as $key=>$item)
            <hr>
            <p class="text-center">Order No:{{++$key}}</p>
            <div class="row mt-5">
                <div class="col-md-6">
                    <h4 class="fw-bold">Shipping Details</h4>
                    <hr>
                   <label for="">First Name</label>
                   <div class="border p-2">{{$item->fname}}</div>
                   <label for="">Last Name</label>
                   <div class="border p-2">{{$item->lname}}</div>
                   <label for="">Email</label>
                   <div class="border p-2">{{$item->email}}</div>
                   <label for="">Contact No.</label>
                   <div class="border p-2">{{$item->phone}}</div>
                   <label for="">Shiping Address</label>
                   <div class="border p-2">
                    
                    {{$item->address1}}
                    {{$item->address2}}
                    {{$item->city}}
                    {{$item->state}}
                    {{$item->country}}
                    </div>
                    <label for="">Zip Code</label>
                    <div class="border p-2">{{$item->pincode}}</div>
                   
               </div>
                <div class="col-md-6">
                    <h4 class="fw-bold">Order Details</h4>
                    <hr>
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
                            @foreach ($item->orderItems as $order)
                                <tr>
                                    <td>
                                        {!!  substr($order->products->name,0,20) !!}...
                                        </td>
                                    <td>{{$order->qty}}</td>
                                    <td>{{$order->price}}</td>
                                    <td><img src="{{asset('assets/uploads/products/'.$order->products->image)}}" height="50px" width="70px" alt="product image"></td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>Grand total <span class="float-end"> <b>BDT</b>{{$item->total_price}}</span></p>
                    <form action="{{url('update-order/'.$item->id)}}" method="post" class="my-4">
                        @csrf
                        @method('PUT')
                        <select class="form-select" name="order_status">
                            <option {{$item->status == '0'? 'selected':''}} value="0">Pending</option>
                            <option {{$item->status == '1'? 'selected':''}} value="1">Complate</option>
                         
                          </select>
                          <button class="btn btn-primary float-end my-3" type="submit">Update</button>
                    </form>
            </div> 
            @endforeach   
            @endif
            </div>
           </div>
        </div>
    </div>
</div>
@endsection