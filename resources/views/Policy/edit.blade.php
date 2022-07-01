@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Edit Policy</h1>
@stop

@section('content')

    <h1 class="text-center mb-5 mt-5">Edit Policy</h1>
    <div class="container">
        <form action="{{url('policy')}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="cat" class="col-form-label">Content</label>
                </div>
                <div class="col-10">
                    <textarea cols="20" rows="14" type="text" name="content" id="username" required="required" class="form-control" autocomplete="off" placeholder="Policy Content"></textarea>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-lg  mx-5" style="width:100%">Edit Policy</button>
                </div>
            </div>

        </form><br>
        @forelse($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @empty

        @endforelse
    </div>

@stop
