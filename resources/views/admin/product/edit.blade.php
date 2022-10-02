@extends('layouts.admin')
@section('title','Add-Product')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit/Update Product</h4>
    </div>
    <div class="card-body">
        <form action="{{url('update-product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                  <!----category----->
               <div class="col-md-12 mb-3">
                <label for="">Category</label>
                <select 
                 class="form-select border p-1 @error('cate_id') is-invalid @enderror"
                 aria-label="Default select example"
                 name="cate_id"
                 required>
                    <option selected>Select A Category</option>
                     @foreach ($category as $item)
                         <option value="{{$item->id}}" 
                            @if ($item->id == $product->cate_id)
                            selected
                             
                         @endif>{{$item->name}}</option>
                     @endforeach
                  </select>
                  @error('cate_id')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
               </div>

                <!----Name----->
                <div class="col-md-6">
                    <label for="">Name</label>
                    <input type="text" class="form-control border bottom p-2 @error('name') is-invalid @enderror" 
                    placeholder="Name"
                    value="{{$product->name}}"
                    name="name" required>
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
                    value="{{$product->slug}}"
                    name="slug" 
                    placeholder="Slug"
                    required>
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                 <!----Small description----->
               <div class="col-md-12 mb-3">
                <label for="">Small Description</label>
                <textarea name="small_description" 
                     class="form-control  border bottom p-2 @error('small_description') is-invalid @enderror"
                     placeholder="Small Description"
                      
                     rows="7" required>{{$product->small_description}}</textarea>
                     @error('small_description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                 <!----Description----->
               <div class="col-md-12 mb-3">
                <label for="">Description</label>
                <textarea name="description" 
                     class="form-control  border bottom p-2 @error('description') is-invalid @enderror"
                     placeholder="Description"
                     rows="7" required>{{$product->description}}</textarea>
                     @error('description')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                 <!----Original price----->
                 <div class="col-md-6">
                    <label for="">Original Price</label>
                    <input type="number" name="original_price"
                    value="{{intval($product->original_price)}}" 
                    placeholder="Original Price"
                    class="form-control border bottom p-2 @error('original_price') is-invalid @enderror"
                    required>
                    @error('original_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 </div>
                 <!----Selling price----->
                 <div class="col-md-6">
                    <label for="">Selling Price</label>
                    <input type="number" name="selling_price" 
                    value="{{intval($product->selling_price)}}"
                    placeholder="Selling Price"
                    class="form-control border bottom p-2 @error('selling_price') is-invalid @enderror"
                    required>
                    @error('selling_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 </div>
                 <!----Showing image----->
                 <div class="col-md-12 my-4 text-center">
                    <img class="edit-image" src="{{asset('assets/uploads/products/'.$product->image)}}" alt="">
                 </div>
                 <!----Image----->
                 <div class="col-md-12 mb-3">
                    <label for="formFileSm" class="form-label">Image</label>
                    <input class="form-control form-control-sm" 
                    name="image"
                    id="formFileSm" type="file"> 
                   </div>
                      <!----Tax----->
                 <div class="col-md-6">
                    <input type="number" name="tax" 
                    value="{{intval($product->tax)}}"
                    placeholder="Tax"
                    class="form-control border bottom p-2 @error('tax') is-invalid @enderror" required>
                    @error('tax')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 </div>
                      <!----Quantity----->
                 <div class="col-md-6">
                    <label for="">Quantity</label>
                    <input type="number" name="qty"
                    value="{{intval($product->qty)}}"
                    placeholder="Quantity"
                    class="form-control border bottom p-2 @error('qty') is-invalid @enderror" required>
                    @error('qty')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 </div>
                <!----status----->
                <div class="col-md-6 mb-3 mt-3">
                    <label for="">Status</label>
                    <input type="checkbox" 
                    class="@error('status') is-invalid @enderror"
                    name="status"
                    {{ $product->status == '1'?'checked':'' }}
                    >
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                <!----Trending----->
                <div class="col-md-6 mb-3 mt-3">
                    <label for="">Trending</label>
                    <input type="checkbox"
                    class="@error('trending') is-invalid @enderror" name="trending"
                    {{ $product->trending == '1'?'checked':'' }}
                    >
                    @error('trending')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                <!----Meta tile----->
                <div class="col-md-6 mb-3">
                    <label for="">Meta Title</label>
                    <input 
                    type="text"
                    name="meta_title"
                    value="{{ $product->meta_title }}"
                    placeholder="Meta title"
                    class="form-control  border bottom p-2 @error('meta_title') is-invalid @enderror"
                    required>
                    @error('meta_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    </div>
               
                <!----Meta Description----->
                <div class="col-md-6 mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" name="meta_description" 
                    value="{{ $product->meta_description }}"
                    placeholder="Meta Description"
                    class="form-control  border bottom p-2 @error('meta_description') is-invalid @enderror"
                    required>
                    @error('meta_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                   </div>
                    <!----Meta keywords----->
                <div class="col-md-12 mb-3">
                    <label for="">Meta keywords</label>
                     <textarea name="meta_keywords" 
                     class="form-control  border bottom p-2 @error('meta_keywords') is-invalid @enderror"
                     placeholder="Meta Keywords"
                     rows="3" required>{{ $product->meta_keywords }}</textarea>
                     @error('meta_keywords')
                     <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                   </div>
                  
                   <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                   </div>
            </div>
        </form>
    </div>
</div>
@endsection