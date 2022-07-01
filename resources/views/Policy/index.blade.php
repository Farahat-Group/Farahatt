@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Coupons</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Content</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$policy['id']}}</td>
            <td>{{$policy['content']}}</td>
            <td>
                <div class="col-6">
                    <a href="{{url('policy/edit/' . $policy['id'])}}"> <button class="btn btn-bg btn-primary w-100">Edit</button></a>
                </div>
            </td>
        </tr>

        </tbody>
    </table>
@stop

