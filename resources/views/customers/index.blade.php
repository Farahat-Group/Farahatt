@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Customers</h1>
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
        @forelse($customers as $customer)
        <tr>
            <th scope="row">{{$customer['id']}}</th>
            <td>{{$customer['name']}}</td>
            <td>{{$customer['email']}}</td>
            <td>
            <form action="{{ route('customer.delete', $customer['id']) }}" method='POST'>
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete" class="btn btn-bg btn-danger">

            </form>
        </td>
        </tr>
        @empty
            No Customers Yet
        @endforelse
        </tbody>
    </table>
@stop

