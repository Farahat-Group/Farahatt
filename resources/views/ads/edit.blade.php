@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Edit Ad</h1>
@stop

@section('content')
    <h1 class="text-center mb-5 mt-5">Edit Ad</h1>
    <div class="container">

        <form action="{{url('ads/' . $ad['id'] ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="userid" value="{{$ad['id']}}">
            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Text</label>
                </div>
                <div class="col-10">
                    <input type="text" name="text" id="username" required="required" class="form-control" autocomplete="off" value="{{$ad['text']}}">
                </div>
            </div>


            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Image</label>
                </div>
                <div class="col-10">
                    <input type="file" name="image" id="username"  class="form-control" autocomplete="off">
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
