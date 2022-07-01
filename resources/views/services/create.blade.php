@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Add Service</h1>
@stop

@section('content')

    <h1 class="text-center mb-5 mt-5">Add Service</h1>
    <div class="container">
        <form action="{{url('services')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Title</label>
                </div>
                <div class="col-10">
                    <input type="text" name="title" id="username" required="required" class="form-control" autocomplete="off" placeholder="Title">
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Description</label>
                </div>
                <div class="col-10">
                    <input type="text" name="description" id="username" required="required" class="form-control" autocomplete="off">
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Price</label>
                </div>
                <div class="col-10">
                    <input type="number" name="price" id="username" required="required" class="form-control" autocomplete="off" placeholder="Price">
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

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Service Code</label>
                </div>
                <div class="col-10">
                    <input type="text" name="service_code" id="username" required="required" class="form-control" autocomplete="off" placeholder="#1928414">
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="cat" class="col-form-label">Category</label>
                </div>
                <div class="col-10">
                    <select name="category_id" id="cat" class="form-control">
                        @foreach($categories as $cat)
                            <option value="{{$cat['id']}}">{{$cat['title']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Main Image</label>
                </div>
                <div class="col-10">
                    <input type="file" class="form-control" name="image" id="username"  autocomplete="off">
                </div>
            </div>

            <div class="row mx-5 mb-4">
                <div class="col-2">
                    <label for="username" class="col-form-label">Extra Images (Upload More Than One)</label>
                </div>
                <div class="col-10">
                    <input type="file"  name="extras[]" multiple class="form-control">
                </div>
            </div>





            <div class="row justify-content-center">
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-lg  mx-5" style="width:100%">Add Service</button>
                </div>
            </div>

        </form><br>
        @forelse($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @empty


        @endforelse
    </div>

@stop
