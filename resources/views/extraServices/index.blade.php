@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Extra Services</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Main Service</th>
            <th scope="col">Price</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($extras as $service)
            <tr>
                <th scope="row">{{$service['id']}}</th>
                <td>{{$service['title']}}</td>
                <td>{{$service->service->title}}</td>
                <td>{{$service['price']}}$</td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <a href="{{url('extra-services/edit/' . $service['id'])}}"> <button class="btn btn-bg btn-primary w-100">Edit</button></a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('extra-services.destroy', $service['id']) }}" method='POST'>
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
   <a href="{{url('extra-services/create')}}"> <button class="btn btn-bg btn-success">Add Extra Service</button></a>
@stop

