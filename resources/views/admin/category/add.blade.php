@extends('layouts.admin')
@section('title','Add-category')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Category</h4>
    </div>
    <div class="card-body">
        <form action="{{url('insert-category')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!----Name----->
                <div class="col-md-6">
                   
                    <input type="text" class="form-control border bottom p-2 @error('name') is-invalid @enderror" 
                    placeholder="Name"
                    name="name"
                    value="{{old('name')}}"
                    required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!----Slug----->
                <div class="col-md-6 mb-3">
                    <input type="text" 
                    class="form-control  
                    border bottom p-2"
                    name="slug"
                    value="{{old('slug')}}"
                    placeholder="Slug"
                    required>
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                 <!----Description----->
               <div class="col-md-12">
                
                <textarea name="description" 
                     class="form-control  border bottom p-2 @error('description') is-invalid @enderror"
                     placeholder="Description"
                     rows="3"
                     value="{{old('description')}}"
                     required></textarea>
                     @error('description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                <!----status----->
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" 
                    class="@error('status') is-invalid @enderror"
                    name="status">
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                <!----popular----->
                <div class="col-md-6 mb-3">
                    <label for="">Popular</label>
                    <input type="checkbox"
                    class="@error('popular') is-invalid @enderror" name="popular">
                    @error('popular')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                <!----Meta tile----->
                <div class="col-md-6 mb-3">
                    
                    <input 
                    type="text"
                    name="meta_title"
                    value="{{old('meta_title')}}"
                    placeholder="Meta title"
                    class="form-control  border bottom p-2 @error('meta_title') is-invalid @enderror" required>
                    @error('meta_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
               
                <!----Meta Description----->
                <div class="col-md-6 mb-3">
                    <input 
                    type="text"
                    name="meta_description"
                    value="{{old('meta_description')}}" 
                    placeholder="Meta Description"
                    class="form-control  border bottom p-2 @error('meta_description') is-invalid @enderror"
                    required
                    >
                    @error('meta_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                    <!----Meta keywords----->
                <div class="col-md-12 mb-3">
                   
                     <textarea name="meta_keywords" 
                     class="form-control  border bottom p-2 @error('meta_keywords') is-invalid @enderror"
                     placeholder="Meta Keywords"
                     rows="3"
                     required></textarea>
                     @error('meta_keywords')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                   </div>
                   <div class="col-md-12 mb-3">
                    <label for="formFileSm" class="form-label">Image</label>
                    <input class="form-control form-control-sm @error('image') is-invalid @enderror" 
                    name="image"
                    id="formFileSm" type="file" required> 
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                   </div>
                   <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                   </div>
            </div>
        </form>
    </div>
</div>
@endsection