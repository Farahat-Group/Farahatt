@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Services</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{$category['id']}}</th>
                <td>{{$category['title']}}</td>
                <td>
                   {{count($category->services)}}
                </td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <a href="{{url('categories/edit' . $category['id'])}}"> <button class="btn btn-bg btn-primary w-100">Edit</button></a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('categories.delete', $category['id']) }}" method='POST'>
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-bg btn-danger">

                            </form>
                        </div>

                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
   <a href="{{url('categories/create')}}"> <button class="btn btn-bg btn-success">Add Category</button></a>
@stop

