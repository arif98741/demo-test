@extends('layouts.front')
@section('title')
    {{$category->meta_title}}
@endsection
@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
<div class="container">
    <h6 class="mb-0">
        Collections/ {{$category->name}} 
    </h6>
</div>
</div>
    <div class="py-5">
        <div class="container">
            <div class="row">
               
                <div class="col-md-12">
                    <h3 class="pb-3"> {{$category->name}}</h3>
                    <div class="row">
                        @if ($products->isEmpty())
                        <h3 class="text-center">No Products</h3>
                            @else
                            @foreach ($products as $product)
                            <div class="col-md-4 mb-4">
                               
                                <a href="{{url('category/'.$category->slug.'/'.$product->slug)}}" class="anchor-style">
                                    <div class="card">
                                        <img src="{{asset('assets/uploads/products/'.$product->image)}}" alt="category image">
                                        <div class="card-body">
                                           <h3> {{
                                            $product->name
                                           }}</h3>
                                          <p>
                                            <span class="float-start">BDT {{ $product->selling_price }}</span>
                                            <span class="float-end"><s>BDT  {{ $product->original_price }}</s></span>
                                                </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            @endforeach
                        @endif
                       
                    </div>
                   
                </div>
            </div>
        </div>
    </div>   
@endsection











