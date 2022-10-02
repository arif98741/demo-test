@extends('layouts.admin')
@section('title','dashboard')
@section('content')
<div class="contaner">
    <div class="row">
        <div class="col-md-4  mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Users <br> {{ $users}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Products <br>{{ $products }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 ">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Categories <br> {{ $categories }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4  mb-5">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Visitors </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h4>New User</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 ">
            <div class="card">
                <div class="card-body text-center">
                    <h4> Cart Products </h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection