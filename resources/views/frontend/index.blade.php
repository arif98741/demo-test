@extends('layouts.front')
@section('title')
    Welcome to Rovers
@endsection
@section('content')
@include('layouts.inc.slider',['slider'=>$slider])
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2  class="pb-3">Featured Products</h2>
                <div class="owl-carousel owl-theme">
                    @foreach ($featured_products as $product)
                    <div>
                        <a href="{{url('/category/'.$product->category->slug.'/'.$product->slug)}}" class="anchor-style">
                            <div class="card">
                                <img width="100%" src="{{asset('assets/uploads/products/'.$product->image)}}" alt="product image">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <span class="float-start"> BDT  {{ $product->selling_price }}</span>
                                    <span class="float-end"><s> 
                                        BDT
                                        {{ $product->original_price }}</s></span>
                                </div>
                            </div>
                        </a>
                        
                    </div> 
                    @endforeach
                    
                </div>
              
              
            </div>
        </div>
    </div>
    <!----trending category------>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2 class="pb-3">Trending Category</h2>
                <div class="owl-carousel owl-theme">
                    @foreach ($trending_category as $tcategory)
                    <div >
                        <a href="{{url('view-category/'.$tcategory->slug)}}" class="anchor-style ">
                            <div class="card">
                                <img width="100%" src="{{asset('assets/uploads/category/'.$tcategory->image)}}" alt="product image">
                                <div class="card-body">
                                    <h5>{{ $tcategory->name }}</h5>
                                    <p>{{
                                        $tcategory->description
                                        }}
                                    </p>
                                </div>
                            </div>
                        </a>
                      
                    </div> 
                    @endforeach
                    
                </div>
              
              
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
    </script>
@endsection