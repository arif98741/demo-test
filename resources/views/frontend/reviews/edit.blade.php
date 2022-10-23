@extends('layouts.front')
@section('title')
   Edit Review of {{$review->product->name}}
@endsection
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-5 py-3">
                <div class="card body">
                    
                    <h5 class="p-2">You are editing a review for {{$review->product->name}}</h5>
                    <form action="{{url('/update')}}" method="post">
                        @csrf
                        @method('PUT')
                    <!------product id----->
                    <input type="hidden" 
                    name="review_id"
                    value="{{$review->id}}">
                    <!------review----->
                    <textarea class="form-control" name="user_review" 
                    placeholder="Write a review"
                    rows="5" required>{{$review->user_review}}</textarea>
                    <button type="submit" class="btn btn-success my-3">Submit</button>
                    </form>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
