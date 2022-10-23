@extends('layouts.front')
@section('title')
    Review of {{$product->meta_title}}
@endsection
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-5 py-3">
                <div class="card body">
                    @if ($verified_purchese->count() > 0)
                    <h5 class="p-2">You are writing a review for {{$product->name}}</h5>
                    <form action="{{url('/add-review')}}" method="post">
                        @csrf
                    <!------product id----->
                    <input type="hidden" 
                    name="prod_id"
                    value="{{$product->id}}">
                    <!------review----->
                    <textarea class="form-control" name="user_review" 
                    placeholder="Write a review"
                    rows="5" required></textarea>
                    <button type="submit" class="btn btn-success my-3">Submit</button>
                    </form>
                    @else
                    <div class="alert alert-danger">
                       <h5> You are not eligible to review this product</h5>
                       <p>
                        For the trustworthiness of the reviews, only customers who purchased the product can write a review about the product.
                       </p>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
