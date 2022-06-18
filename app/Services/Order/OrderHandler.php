<?php

namespace App\Services\Order;

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
        $this->cash = $this->getCash();
        $this->customer = Auth::user()->id;
    }

    public function getCash()
    {
        return CartServices::getCartTotalCash();
    }

    public function createOrder()
    {

        $payment = 'cash';
        $code = null;
        if (!$this->cart)
            return "cart Empty";
        $cash = $this->cash;
        $finalCash = $cash;
        $sale = 0;
        if (request()->has('coupon')) {
            $sale = CouponServices::handle();
            if ($sale != 0) {
                $percent = $cash / 100;
                $finalCash =  $cash - ($percent * $sale);
            }
        }

        if (request('payment_method') == 'vodafone_cash') {
            $payment = 'vodafone_cash';
            $code = request('payment_code');
        }

        $order = Order::create([
            'cash' => $cash,
            'customer_id' => $this->customer,
            'status' => 'in progress',
            'sale' => $sale,
            'final_cash' => $finalCash,
            'payment_method' => $payment,
            'payment_code' => $code,
            'created_at' => Carbon::now()
        ]);

        $notificaion = Notification::create([
            'customer_id' => Auth()->user()->id,
            'message' => 'Your Order Have Been Placed And Will Be Checked',
            'price' => $finalCash
        ]);
        foreach ($this->cart->services as $service) {
            DB::table('orders_services')->insert([
                'quantity' => $service['quantity'],
                'service_id' => $service['service_id'],
                'order_id' => $order['id']
            ]);
        }
    }
}
