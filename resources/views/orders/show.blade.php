@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Order Details</h1>
@stop

@section('content')

    <h1 class="text-center mb-5 mt-5">Order Details</h1>
    <div class="container">
        <div class="d-inline-block mr-5">
            <h3>Order id</h3> <span style="color: #000;font-weight: bold;font-size: 20px">{{$order['id']}}</span>
        </div>
        <div class="d-inline-block mr-5">
            <h3>Order Amount</h3> <span style="color: #000;font-weight: bold;font-size: 20px">{{$order['cash'] - $order['sale']}}</span>
        </div>
        <div class="d-inline-block mr-5">
            <h3>Order Sale</h3> <span style="color: #000;font-weight: bold;font-size: 20px">{{ $order['sale']}}</span>
        </div>

        <div class="d-inline-block mr-5">
            <h3>Payment Method</h3> <span style="color: #000;font-weight: bold;font-size: 20px">
                 @switch($order->payment_method)
                    @case(0)
                    Vodafone Cash : <span style="color: #F00"> {{$order->payment_code}}</span>
                    @break

                    @case(1)
                    Cash On Delivery
                    @break
                @endswitch
            </span>
        </div>
        <br><br><br><br>


        <div class="row">
            @if($order['status'] == 0)
            <div class="col-6">
                    <a href="{{url('orders/accept/' . $order['id'])}}"><button class="btn btn-lg btn-success">Accept Order</button></a>
            </div>
            @endif
                <div class="col-3">
                    <form action="{{ route('orders.destroy', $order['id']) }}" method='POST'>
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-bg btn-danger w-100">

                    </form>
                </div>
        </div>

        <h2 class="mt-5 ml-3">Order Products</h2>
        <br><br><br>

        <div class="row">
                @foreach($order->services as $service)
                <div class="card mr-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{url('images/services/') . $service->service['images']}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$service->service->title}}</h5>
                        <p class="card-text">{{$service->service->description}}</p>
                        <p class="card-text">Price: {{$service->service->price}}</p>
                        <p class="card-text">PriceAfterSale: {{$service->service->priceAfterSale}}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                @endforeach
            </div>



    </div>

@stop
