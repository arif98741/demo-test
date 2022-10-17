@extends('layouts.admin')
@section('title','Slider')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Slider Details</h4>
        <a href="/add-slider" class="btn btn-primary float-end">Add Slider</a>
    </div>
    <div class="card-body">
        @if ($slider->isEmpty())
        <h4 class="fw-bold text-center">No Slider</h4>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tbody>
                  
                    @foreach ($slider as $row)
                    <tr>
                        <td>{{$row->title}}</td>
                        <td>{{$row->description}}</td>
                        <td>
                            <img src="{{asset('assets/uploads/slider/'.$row->image)}}" alt="slider" width="130px">
                        </td>
                        <td>
                            <a href="{{ url('edit-slider/'.$row->id) }}" class="text-primary  me-3">
                                <i class="material-icons opacity-10">edit</i>
                                </a>
                            <a 
                            href="{{url('delete-slider/'.$row->id)}}"
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
            </tbody>
           </table>
       @endif
      
    </div>

</div>
@endsection