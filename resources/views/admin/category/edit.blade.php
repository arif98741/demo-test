@extends('layouts.admin')
@section('title','Add-category')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit/Update Category</h4>
    </div>
    <div class="card-body">
        <form action="{{url('update-category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!----Name----->
                <div class="col-md-6">
                   <label for="">Name</label>
                    <input type="text" class="form-control border bottom p-2 @error('name') is-invalid @enderror" 
                    placeholder="Name"
                    value="{{$category->name}}"
                    name="name"
                    required
                    >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <!----Slug----->
                <div class="col-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" 
                    class="form-control  
                    border bottom p-2 @error('slug') is-invalid @enderror"
                    name="slug" 
                    value="{{$category->slug}}"
                    placeholder="Slug"
                    required
                    >
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                 <!----Description----->
               <div class="col-md-12">
                <label for="">Description</label>
                <textarea name="description" 
                     class="form-control  border bottom p-2 @error('description') is-invalid @enderror"
                     placeholder="Description"
                    
                     rows="3"
                     required
                     >{{$category->description}}</textarea>
                     @error('description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                <!----status----->
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" 
                    {{$category->status == '1'?'checked':''}}
                     
                    name="status">
                   </div>
                <!----popular----->
                <div class="col-md-6 mb-3">
                    <label for="">Popular</label>
                    <input type="checkbox"
                    {{$category->popular == '1'?'checked':''}}
                     name="popular">
                   </div>
                <!----Meta tile----->
                <div class="col-md-6 mb-3">
                    <label for="">Meta Title</label>
                    <input 
                    type="text"
                    name="meta_title"
                    value="{{$category->meta_title}}"
                    placeholder="Meta title"
                    class="form-control  border bottom p-2 @error('meta_title') is-invalid @enderror" required>
                    @error('meta_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
               
                <!----Meta Description----->
                <div class="col-md-6 mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" name="meta_description" 
                    placeholder="Meta Description"
                    value="{{$category->meta_description}}"
                    class="form-control  border bottom p-2 @error('meta_description') is-invalid @enderror" required>
                    @error('meta_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                    <!----Meta keywords----->
                <div class="col-md-12 mb-3">
                    <label for="">Meta Keywords</label>
                     <textarea name="meta_keywords" 
                     class="form-control  border bottom p-2 @error('meta_keywords') is-invalid @enderror"
                     placeholder="Meta Keywords"
                     rows="3"
                     required
                     >
                     {{$category->meta_keywords}}
                    </textarea>
                     @error('meta_keywords')
                     <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                   </div>
                    <!---Showing image----->
                   <div class="col-md-12 my-4 text-center">
                    <img class="  edit-image" src="{{asset('assets/uploads/category/'.$category->image)}}" alt="">
                   </div>
                   <!---Image----->
                   <div class="col-md-12 mb-3">
                    <label for="formFileSm" class="form-label">Image</label>
                    <input class="form-control form-control-sm" 
                    name="image"
                    id="formFileSm" type="file"> 
                   </div>
                   <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                   </div>
            </div>
        </form>
    </div>
</div>
@endsection