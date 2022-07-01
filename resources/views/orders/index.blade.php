@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Notifications</h1>
@stop

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">order_id</th>
            <th scope="col">Customer</th>
            <th scope="col">Cash</th>
            <th scope="col">Sale</th>
            <th scope="col">Price After Sale</th>
            <th scope="col">Status</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{$order['id']}}</th>
                <td>{{$order->customer->name}}</td>
                <td>{{$order->cash}}</td>
                <td>{{$order['sale']}}$</td>
                <td>{{$order->cash - $order->sale}}$</td>
                <td>
                    @switch($order->status)
                    @case(0)
                    On Hold
                    @break

                    @case(1)
                    Processing
                    @break

                    @case(2)
                    Completed
                    @break

                    @default
                    Rejected
                    @endswitch
                </td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <form action="{{ route('orders.destroy', $order['id']) }}" method='POST'>
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-bg btn-danger w-100">

                            </form>
                        </div>

                        <div class="col-6">
                            <a href="{{url('orders/' . $order['id'])}}"> <button class="btn btn-bg btn-primary w-100">Details</button></a>
                        </div>

                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

