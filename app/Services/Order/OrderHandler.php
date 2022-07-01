<?php

namespace App\Services\Order;

use App\Events\OrderPlaced;
use App\Http\Controllers\Api\CouponController;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\Order;
use App\Services\Cart\CartServices;
use App\Services\coupon\CouponServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderHandler
{

    protected   Cart $cart;
    protected float $cash;
    protected int $customer;


    public function __construct()
    {
        $this->cart = Cart::where('customer_id', Auth::user()->id)->first() ?? null;
        $this->customer = Auth::user()->id;
    }
    public function createOrder()
    {

        $code = null;
        $coupon = null;
        if (!$this->cart)
            return "cart Empty";
        $cash = CartServices::getCartTotalCash();
        $finalCash = $cash;
        $sale = 0;
        if (request()->has('coupon')) {
            $coupon = request('coupon');
            $sale = CouponServices::handle();
            if ($sale != 0) {
                $finalCash =  $cash - $sale;
            } else {
                return false;
            }
        }
        $extra =  CartServices::getExtrasCash();

        if (request('payment_method') == 0) {
            $code = request('payment_code');
        }

        $order = Order::create([
            'cash' => $cash,
            'customer_id' => $this->customer,
            'status' => '0',
            'extras' =>  $extra,
            'sale' => $sale,
            'final_cash' => ($cash + $extra) - $sale,
            'payment_method' => request('payment_method'),
            'payment_code' => $code,
            'coupon' => $coupon,
        ]);
        //event(new OrderPlaced($order));
        foreach ($this->cart->allServices as $service) {
            DB::table('orders_services')->insert([
                'quantity' => $service['quantity'],
                'service_id' => $service['service_id'],
                'order_id' => $order['id'],
                'type' =>$service['type']
            ]);
        }

        return true;
    }
}
