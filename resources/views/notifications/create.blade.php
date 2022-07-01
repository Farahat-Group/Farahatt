@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Add Notification</h1>
@stop

@section('content')

    <h1 class="text-center mb-5 mt-5">Add Notification</h1>
    <div class="container">
        <form action="{{url('notifications')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="cat" class="col-form-label">Customer</label>
                </div>
                <div class="col-10">
                    <select name="customer_id" id="cat" class="form-control">
                        @foreach($customers as $service)
                            <option value="{{$service['id']}}">{{$service['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Title</label>
                </div>
                <div class="col-10">
                    <input type="text" name="title" id="username" required="required" class="form-control" autocomplete="off" placeholder="Message">
                </div>
            </div>


            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Message</label>
                </div>
                <div class="col-10">
                    <input type="text" name="message" id="username" required="required" class="form-control" autocomplete="off" placeholder="Message">
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Price</label>
                </div>
                <div class="col-10">
                    <input type="number" name="price" id="username" class="form-control" autocomplete="off" placeholder="Price">
                </div>
            </div>






            <div class="row justify-content-center">
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-lg  mx-5" style="width:100%">Send Notification</button>
                </div>
            </div>

        </form><br>
        @forelse($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @empty

        @endforelse
    </div>

@stop
