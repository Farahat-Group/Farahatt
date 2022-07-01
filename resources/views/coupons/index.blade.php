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
            <th scope="col">Coupon</th>
            <th scope="col">Sale</th>
            <th scope="col">Coupon</th>

        </tr>
        </thead>
        <tbody>
        @foreach($coupons as $coupon)
            <tr>
                <th scope="row">{{$coupon['id']}}</th>
                <td>{{$coupon->coupon}}</td>
                <td>{{$coupon->sale}}$</td>
                <td width="200px">
                    <div class="row w-100">
                        <div class="col-6">
                            <form action="{{ route('coupons.destroy', $coupon['id']) }}" method='POST'>
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
    <a href="{{url('coupon/create')}}"> <button class="btn btn-bg btn-success">Add Coupon</button></a>
@stop

