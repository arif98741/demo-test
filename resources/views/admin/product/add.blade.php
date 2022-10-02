@extends('layouts.admin')
@section('title','Add-Product')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Product</h4>
    </div>
    <div class="card-body">
        <form action="{{url('insert-product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                  <!----category----->
               <div class="col-md-12 mb-3">
                <select 
                 class="form-select border p-1
                 @error('cate_id') is-invalid @enderror"
                 aria-label="Default select example"
                 name="cate_id"
                  required>
                    <option value="">Select A Category</option>
                     @foreach ($category as $item)
                         <option value="{{$item->id}}">{{$item->name}}</option>
                     @endforeach
                  </select>
                  @error('cate_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
               </div>

                <!----Name----->
                <div class="col-md-6">
                   
                    <input type="text" class="form-control border bottom p-2 @error('name') is-invalid @enderror" 
                    placeholder="Name"
                    name="name" required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <!----Slug----->
                <div class="col-md-6 mb-3">
                    <input type="text" 
                    class="form-control  
                    border bottom p-2 @error('slug') is-invalid @enderror"
                    name="slug" 
                    placeholder="Slug"
                    required>
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                 <!----Small_description----->
               <div class="col-md-12 mb-3">
                
                <textarea name="small_description" 
                     class="form-control  border bottom p-2 @error('small_description') is-invalid @enderror"
                     placeholder="Small Description"
                     rows="3" required></textarea>
                     @error('small_description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                 <!----Description----->
               <div class="col-md-12 mb-3">
                
                <textarea name="description" 
                     class="form-control  border bottom p-2 @error('description') is-invalid @enderror"
                     placeholder="Description"
                     rows="3" required></textarea>
                     @error('description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                 <!----Original price----->
                 <div class="col-md-6">
                    <input type="number" name="original_price" 
                    placeholder="Original Price"
                    class="form-control border bottom p-2 @error('original_price') is-invalid @enderror" required>
                    @error('original_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 </div>
                 <!----Selling price----->
                 <div class="col-md-6">
                    <input type="number" name="selling_price" 
                    placeholder="Selling Price"
                    class="form-control border bottom p-2  @error('selling_price') is-invalid @enderror" required>
                    @error('selling_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 </div>
                 <!----Image----->
                 <div class="col-md-12 mb-3">
                    <label for="formFileSm" class="form-label">Image</label>
                    <input class="form-control form-control-sm @error('image') is-invalid @enderror" 
                    name="image"
                    id="formFileSm" type="file"
                    required>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
                   </div>
                      <!----Tax----->
                 <div class="col-md-6">
                    <input type="number" name="tax" 
                    placeholder="Tax"
                    class="form-control border bottom p-2 @error('tax') is-invalid @enderror" required>
                    @error('tax')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
                 </div>
                      <!----Quantity----->
                 <div class="col-md-6">
                    <input type="number" name="qty" 
                    placeholder="Quantity"
                    class="form-control border bottom p-2 @error('qty') is-invalid @enderror"
                    required>
                    @error('qty')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
                 </div>
                <!----status----->
                <div class="col-md-6 mb-3 mt-3">
                    <label for="">Status</label>
                    <input type="checkbox" 
                    class="@error('status') is-invalid @enderror"
                    name="status">
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                <!----Trending----->
                <div class="col-md-6 mb-3 mt-3">
                    <label for="">Trending</label>
                    <input type="checkbox"
                    class="@error('trending') is-invalid @enderror" name="trending">
                    @error('trending')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                <!----Meta tile----->
                <div class="col-md-6 mb-3">
                    
                    <input 
                    type="text"
                    name="meta_title"
                    placeholder="Meta title"
                    class="form-control  border bottom p-2 @error('meta_title') is-invalid @enderror" required>
                    @error('meta_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
               
                <!----Meta Description----->
                <div class="col-md-6 mb-3">
                    <input type="text" name="meta_description" 
                    placeholder="Meta Description"
                    class="form-control  border bottom p-2 @error('meta_description') is-invalid @enderror" required>
                    @error('meta_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                    <!----Meta keywords----->
                <div class="col-md-12 mb-3">
                   
                     <textarea name="meta_keywords" 
                     class="form-control  border bottom p-2 @error('meta_keywords') is-invalid @enderror"
                     placeholder="Meta Keywords"
                     rows="3" required></textarea>
                     @error('meta_keywords')
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