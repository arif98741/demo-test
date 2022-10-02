@extends('layouts.front')
@section('title','My order')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
           <div class="card-header bg-primary text-white py-3">
            <h5>Order Details <a href="{{url('orders')}}" class="btn btn-secondary float-end">Back</a></h5>
            
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
                    <form action="{{url('update-order/'.$orders->id)}}" method="post" class="my-4">
                        @csrf
                        @method('PUT')
                        <select class="form-select" name="order_status">
                            <option {{$orders->status == '0'? 'selected':''}} value="0">Pending</option>
                            <option {{$orders->status == '1'? 'selected':''}} value="1">Complate</option>
                         
                          </select>
                          <button class="btn btn-primary float-end my-3" type="submit">Update</button>
                    </form>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
@endsection