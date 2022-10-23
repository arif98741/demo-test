@extends('layouts.front')
@section('title','My Wishlist')
@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}" class="anchor-style">Home</a>/<a href="{{url('/wishlist')}}" class="anchor-style">wishlist</a>
        </h6>
    </div>
</div>
<div class="container my-5 mywishlist">
    <div class="card shadow">
        <div class="card-body">
            @if ($wishlists->count() >0)
            <div class="card-body">
                @foreach ($wishlists as $wishlist)
                <div class="row product_data">
                    <div class="col-md-2">
                        <img 
                        src="{{asset('assets/uploads/products/'.$wishlist->products->image)}}"
                        height="70px"
                         alt="product_image">
                    </div>
                    <div class="col-md-4">
                        <h4>{{$wishlist->products->name}}</h4>
                        <small><span class="fw-bold">BDT</span> {{$wishlist->products->selling_price}}</small>
                    </div>
                    <div class="col-md-2 quantity">
                        <input type="hidden" class="prod_id"  value="{{ $wishlist->prod_id }}">
                        @if ($wishlist->products->qty >=$wishlist->prod_qty)
                        <label for="Quantity">Quantity</label>
                        <div class="input-group text-center mb-3" style="width:  130px">
                               
                                    <button class="input-group-text decrement-btn " style="cursor: pointer"
                                    >
                                        -
                                    </button>
                                <input type="text" name="quantity"
                                value="1" 
                                class="form-control qty-input text-center"
                                >
                                    <button 
                                    style="cursor: pointer" class="input-group-text increment-btn">
                                        +
                                    </button>
                                
                            </div>
                            <input type="hidden" name="prod_id" value="{{$wishlist->prod_id}}">
                            @else
                            <p class="badge bg-danger">Out of stock</p>
                            
                        @endif
                        
                    </div>
                    @if (!$wishlist->products->qty == '0')
                    <div style="cursor: pointer" class="col-md-2 mt-3 text-danger">
                        
                        <button class=" btn btn-success 
                        btn-sm addToCart
                        "><i class="fa-solid fa-cart-shopping"></i>Add to cart</button>
                    </div>
                    @else
                    <div style="cursor: pointer" class="col-md-2 mt-3 text-danger">
                        <span class="badge bg-danger">
                            Out of stock
                        </span>
                    </div>
                    @endif
                    <div style="cursor: pointer" class="col-md-2 mt-3 text-danger">
                        
                        <button class="btn btn-danger 
                        btn-sm remove-wishlist-item
                        "><i class="fa-solid fa-trash"></i> Remove</button>
                    </div>
                </div>
               
            @endforeach
            @else
        </div>
              
        <h4 class="text-center my-5 fw-bold">There are no products in your wishlist</h4>
    
         </div>
           @endif
            
    </div>
</div>

@endsection