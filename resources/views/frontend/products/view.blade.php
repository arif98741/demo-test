@extends('layouts.front')
@section('title')
    {{$product->meta_title}}
@endsection
@section('content')
<!---rating----->
  
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$product->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('/add-rating')}}" method="post">
                @csrf
                <input type="hidden" name="prod_id" value="{{$product->id}}">
            <div class="rating-css">
                <div class="star-icon">
                    @if($user_rating)
                    
                     @for ($i = 0; $i < $user_rating->stars_rated; $i++)
                     <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                     <label for="rating{{$i}}" class="fa fa-star"></label>
                     @endfor
                     @for ($j = $user_rating->stars_rated+1 ; $j <=5; $j++)
                       <input type="radio" value="{{$j}}" name="product_rating"  id="rating{{$j}}">
                       <label for="rating{{$j}}" class="fa fa-star"></label>
                    @endfor
                    @else
                    
                        <input type="radio" value="1" name="product_rating" checked id="rating1">
                        <label for="rating1" class="fa fa-star"></label>
                
                        <input type="radio" value="2" name="product_rating"  id="rating2">
                        <label for="rating2" class="fa fa-star"></label>
                
                        <input type="radio" value="3" name="product_rating"  id="rating3">
                        <label for="rating3" class="fa fa-star"></label>
                
                        <input type="radio" value="4" name="product_rating"  id="rating4">
                        <label for="rating4" class="fa fa-star"></label>
                
                        <input type="radio" value="5" name="product_rating"  id="rating5">
                        <label for="rating5" class="fa fa-star"></label>
                    @endif
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
<!---endrating----->
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            Collections/ {{$product->category->name}} /{{$product->name}}
        </h6>
    </div>
</div>
<div class="container py-2">
    <div class="card shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('assets/uploads/products/'.$product->image)}}" width="100%" alt="">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{$product->name}}
                        @if ($product->trending == '1')
                        <label  style="font-size: 16px" class="float-end badge bg-danger">Trending
                        </label>
                        @endif
                    </h2>
                    <hr>
                    <label  class="me-3">
                        Original Price : BDT <s>{{ $product->original_price }}</s></label>
                    <label  class="fw-bold">
                        Selling Price : BDT {{ $product->selling_price }}
                    </label>
                    <br>
                    @php
                    $ratenum =  number_format($rating_value)
                    @endphp
                    @for ($i = 0; $i < $ratenum; $i++)
                        <i class="fa fa-star text-warning"></i>
                    @endfor
                    @for ($j = $ratenum+1; $j <=5 ; $j++)
                    <i class="fa fa-star "></i>
                    @endfor 
                    @if ($ratings->count() > 0)
                        <small>{{$ratings->count()}} Ratings</small>
                    @else
                    <b>No Ratings</b>
                    @endif
                    <p class="mt-3">
                        {!! $product->small_description !!}
                    </p>
                    <hr>
                    @if ($product->qty > 0)
                        <label class="badge bg-success">
                            In stock
                        </label>
                        @else
                        <label class="badge bg-danger">
                            Out of stock
                        </label>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-2 col-5 quantity">
                            <input type="hidden" value="{{$product->id}}" name="" class="prod_id">
                            <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <div class="decrement-btn" 
                                style="cursor: pointer">
                                    <span class="input-group-text">
                                        -
                                    </span>
                                </div>
                              
                                <input type="text" name="quantity"
                                value="1" 
                                class="form-control qty-input text-center"
                                >
                                <div class="increment-btn" style="cursor: pointer">
                                    <span class="input-group-text">
                                        +
                                    </span>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-10">
                            <br>
                            <button type="button" class="btn btn-success me-3 float-start addToWishlist">Add to Wishlist 
                                <i class="fa fa-heart"></i>
                            </button>
                          @if ($product->qty > 0 )
                          <button type="button" class="btn btn-primary me-3 float-start addToCart">
                            Add To Cart
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                              
                          @endif
                        </div>
                    </div>
                </div>
                <div class="m-2">
                    <h4>Description</h4>
                    <p class="my-3">
                        {!! $product->description !!}
                    </p>
                   
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <a href="" class="btn btn-link btn-sm"
                   
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate this Product
                        </a>
                        <a href="/add-review/{{$product->slug}}/userreview" class="btn btn-link">White a review</a>
                    </div>
                    <div class="col-md-8">
                    @foreach ($review as $item)
                        <label for="">{{$item->user->name}}</label>
                        @if ($item->user_id == Auth::id())
                        <a href="{{url('edit-review/'.$product->slug.'/userreview')}}">Edit</a>
                        @endif
                        <br>
                       @php
                            $rating = App\Models\Rating::where('prod_id',$product->id)->where('user_id',$item->user->id)->first();
                       @endphp
                        @if ($rating)
                        @php
                            $user_rated =  $rating->stars_rated
                        @endphp
                        @for ($i = 0; $i < $user_rated; $i++)
                        <i class="fa-solid fa-star text-warning"></i>
                        @endfor
                        @for ($j = $user_rated+1 ; $j <=5; $j++)
                        <i class="fa-solid fa-star "></i>
                       @endfor
                        @endif
                        <small>Reviewed on {{$item->created_at->format('d M Y')}}</small>
                        <p>{{$item->user_review}}</p>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
