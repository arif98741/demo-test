@extends('layouts.front')
@section('title')
    Category
@endsection
@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row">
               
                <div class="col-md-12">
                    <h3 class="pb-3">All Categories</h3>
                    <div class="row">
                        @foreach ($category as $cate)
                        <div class="col-md-4 mb-4">
                           <a href="{{url('view-category/'.$cate->slug)}}" class="anchor-style ">
                            <div class="card">
                                <img src="{{asset('assets/uploads/category/'.$cate->image)}}" alt="category image">
                                <div class="card-body">
                                   <h3> {{
                                    $cate->name
                                }}</h3>
                                <p>
                                    {{$cate->description}}
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
    </div>
@endsection
