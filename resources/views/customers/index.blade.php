@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h2>Users</h2>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @forelse($customers as $customer)
        <tr>
            <th scope="row">{{$customer['id']}}</th>
            <td>{{$customer['name']}}</td>
            <td>{{$customer['email']}}</td>
            <td>Control</td>
        </tr>
        @empty
            No Users
        @endforelse
        </tbody>
    </table>
@stop



@section('js')
    <script> console.log('Hi!'); </script>
@stop
