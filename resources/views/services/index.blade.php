@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Sale</th>
            <th scope="col">Service Code</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <th scope="row">{{$service['id']}}</th>
                <td>{{$service['title']}}</td>
                <td>{{$service->category->title}}</td>
                <td>{{$service['price']}}$</td>
                <td>{{$service['sale']}}%</td>
                <td>{{$service['service_code']}}</td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <a href="{{url('services/edit/' . $service['id'])}}"> <button class="btn btn-bg btn-primary w-100">Edit</button></a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('services.destroy', $service['id']) }}" method='POST'>
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-bg btn-danger w-100">

                            </form>
                        </div>

                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
   <a href="{{url('services/create')}}"> <button class="btn btn-bg btn-success">Add Service</button></a>
@stop

