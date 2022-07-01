@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Notifications</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Customer</th>
            <th scope="col">Message</th>
            <th scope="col">Sale</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notifications as $service)
            <tr>
                <th scope="row">{{$service['id']}}</th>
                <td>{{$service->customer->name}}</td>
                <td>{{$service->message}}</td>
                <td>{{$service['price']}}$</td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <form action="{{ route('notifications.destroy', $service['id']) }}" method='POST'>
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
   <a href="{{url('notifications/create')}}"> <button class="btn btn-bg btn-success">Send Notification</button></a>
@stop

