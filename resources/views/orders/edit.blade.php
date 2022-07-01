@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Edit Extra Service</h1>
@stop

@section('content')
    <h1 class="text-center mb-5 mt-5">Edit Extra Service</h1>
    <div class="container">

        <form action="{{url('extra-services/' . $service['id'] ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="userid" value="{{$service['id']}}">
            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Title</label>
                </div>
                <div class="col-10">
                    <input type="text" name="title" id="username" required="required" class="form-control" autocomplete="off" value="{{$service['title']}}">
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Price</label>
                </div>
                <div class="col-10">
                    <input type="text" name="price" id="username" required="required" class="form-control" autocomplete="off" value="{{$service['price']}}">
                </div>
            </div>


            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="cat" class="col-form-label">Service</label>
                </div>
                <div class="col-10">
                    <select name="service_id" id="cat" class="form-control">
                        @foreach($services as $service)
                            <option value="{{$service['id']}}">{{$service['title']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>





            <div class="row justify-content-center">
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-lg  mx-5" style="width:100%">Save</button>
                </div>
            </div>
            <br>
            @forelse($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
                @empty
            @endforelse
        </form>
    </div>

@stop
