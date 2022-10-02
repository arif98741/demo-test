@extends('layouts.admin')
@section('title','Users')
@section('content')
<div class="card">
     <div class="card-header">
       <h4>Registed Users</h4>
       <hr>
     </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($users as $row)
               <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{  $row->email}}</td>
                <td>{{$row->phone}}</td>
               
                <td>
                    <a href="{{ url('view-user/'.$row->id) }}"
                    class="btn btn-success">
                    view
                   </a>
            
                </td>
                
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

