@extends('layouts.admin')
@section('title','view-user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="role">Role</label>
                            <div class="p-2 border">{{$user->role_as == '1'?'Admin':'User'}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="firstname">First Name</label>
                            <div class="p-2 border">{{$user->name}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="lastname">Last Name</label>
                            <div class="p-2 border">{{$user->lname}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email</label>
                            <div class="p-2 border">{{$user->email}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="phone">Phone</label>
                            <div class="p-2 border">{{$user->phone}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="address1">Address1</label>
                            <div class="p-2 border">{{$user->address1}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="address2">Address2</label>
                            <div class="p-2 border">{{$user->address2}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="city">City</label>
                            <div class="p-2 border">{{$user->city}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="state">State</label>
                            <div class="p-2 border">{{$user->state}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="country">Country</label>
                            <div class="p-2 border">{{$user->country}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="pincode">Pin code</label>
                            <div class="p-2 border">{{$user->pincode}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection