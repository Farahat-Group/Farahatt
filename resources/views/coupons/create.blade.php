@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Add Coupon</h1>
@stop

@section('content')

    <h1 class="text-center mb-5 mt-5">Add Coupon</h1>
    <div class="container">
        <form action="{{url('coupons')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="cat" class="col-form-label">Coupon</label>
                </div>
                <div class="col-10">
                    <input type="text" name="coupon" id="username" required="required" class="form-control" autocomplete="off" placeholder="Coupon">
                </div>
            </div>


            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Sale</label>
                </div>
                <div class="col-10">
                    <input type="number" name="sale" id="username" required="required" class="form-control" autocomplete="off" placeholder="Sale">
                </div>
            </div>



            <div class="row justify-content-center">
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-lg  mx-5" style="width:100%">Create Coupon</button>
                </div>
            </div>

        </form><br>
        @forelse($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @empty

        @endforelse
    </div>

@stop
