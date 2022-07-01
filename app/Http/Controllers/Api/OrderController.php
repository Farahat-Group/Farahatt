<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderExtraSerivesResource;
use App\Http\Resources\OrderProductsResource;
use App\Http\Resources\OrdersResource;
use App\Models\Cart;
use App\Models\Order;
use App\Services\Order\OrderHandler;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ApiTraits;
    public function index() {
        $orders = Order::where('customer_id' , Auth::user()->id)->get();
        if (count($orders) == 0)
            return $this->responseJsonWithoutData(200 , 'No Orders Yet');
        return $this->responseJson(200 , 'Orders Returned' , OrdersResource::collection($orders));
    }


    public function show(Order $order){
        return $this->responseJson(200 , 'Order Products Returned' ,
                [
                    'details' => (new OrdersResource($order)),
                    'services' => OrderProductsResource::collection($order->services),
                    //'extra_services' => OrderExtraSerivesResource::collection($order->extraServices)
                ]
            );
    }
    public function store(){

        $cart = Cart::where('customer_id' , Auth::user()->id)->first();
        if(!$cart)
            return $this->responseJsonFailed(422 , 'Cart Empty');
        $order = (new OrderHandler())->createOrder();
        if (!$order)
            return $this->responseJsonFailed(422 , 'Expired Coupon Order Failed');

            Cart::where('customer_id' , Auth::user()->id)->delete();
            return $this->responseJsonWithoutData(200 , 'Order Placed And We Send You An Email With Details !');


    }
}
