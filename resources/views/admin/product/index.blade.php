@extends('layouts.admin')
@section('title','Products')
@section('content')
<div class="card">
     <div class="card-header">
       <h4>Products</h4>
       <hr>
     </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($products as $row)
               <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->category->name}}</td>
                <td>{!!  substr($row->name,0,40) !!}...</td>
                <td>{{$row->selling_price}}</td>
                <td>
                    <img  class="cate-image" src="{{ asset('assets/uploads/products/'.$row->image) }}" alt="category">
                </td>
                <td>
                    <a href="{{ url('edit-product/'.$row->id) }}"
                    class="text-primary me-3">
                    <i class="material-icons opacity-10">edit</i>
                </a>
                </a>
                    <a 
                    href="{{url('delete-product/'.$row->id)}}"
                    class="text-danger" 
                    >
                   
                    <i class="material-icons opacity-10">delete</i>
                </a>
                
                </td>
                
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

