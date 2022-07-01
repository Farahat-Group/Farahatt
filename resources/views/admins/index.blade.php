@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Admins</h1>
@stop

@section('content')


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
        @forelse($admins as $admin)
            <tr>
                <th scope="row">{{$admin['id']}}</th>
                <td>{{$admin['name']}}</td>
                <td>{{$admin['email']}}</td>
                <td>Control</td>
            </tr>
        @empty
            No Admins
        @endforelse
        </tbody>
    </table>
@stop



