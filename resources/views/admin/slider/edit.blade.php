@extends('layouts.admin')
@section('title','edit-slider')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Edit/Update Slider</h4>
        <a href="/dashboard" class="btn btn-primary float-end">Home</a>
       
    </div>
    <div class="card-body">
        <form action="{{url('update-slider/'.$editslider->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!----title----->
            <div class="col-md-12">   
                <input type="text" class="form-control border bottom p-2 @error('title') is-invalid @enderror" 
                 placeholder="Title"
                 name="title"
                 value=" {{$editslider->title}}"
                 required>
                 @error('title')
                 <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                </div>
                <!----description----->
            <div class="col-md-12"> 
                <label for="">Description</label>  
                <textarea 
                name="description"
                cols="7"
                rows="5"
                class="form-control border bottom my-3 @error('description') is-invalid @enderror" 
                
                placeholder="Description"
                 value="{{old('description')}}"
                 required> {{$editslider->description}}
                    
                </textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <!----Image----->
                <div class="col-md-12">     
               <label for="">Image</label>
               <input type="file" name="image" 
               onchange="loadFile(event)"
               class="form-control my-2"
               
               >
               @error('image')
               <div class="alert alert-danger">{{ $message }}</div>
               @enderror
                </div>
                  <!----preview image----->
                  <div class="col-md-12 mb-3 text-center">
                    <img id="preview" 
                    src="{{ asset('assets/uploads/slider/'.$editslider->image) }}"
                    width="200px">
                   </div>
                <div class="col-md-12 my-3">
                   <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        <form>
    </div>
<div>
@endsection