@extends('layouts.admin')
@section('title','Categories')
@section('content')
<div class="card">
     <div class="card-header">
       <h4>Category</h4>
       <hr>
     </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($category as $row)
               <tr>
                <td><p>{{$row->id}}</p></td>
                <td><p>{{$row->name}}</p></td>
                <td><small>{{$row->description}}</small></td>
                <td><img  class="cate-image" src="{{ asset('assets/uploads/category/'.$row->image) }}" alt="category"></td>
                <td>
                    <a href="{{ url('edit-category/'.$row->id) }}" class="text-primary  me-3">
                        <i class="material-icons opacity-10">edit</i>
                        </a>
                    <a 
                    href="{{url('delete-category/'.$row->id)}}"
                    class="text-danger" 
                    >
                    <i class="material-icons opacity-10">delete</i>
                    </a>
                    <span class="material-symbols-outlined">
                        
                        </span>
                </td>
                
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection