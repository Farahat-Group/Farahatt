<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Notification;
use App\Models\Order;

class SendNotificationToUser
{

    public function __construct()
    {
        //
    }


    public function handle(OrderPlaced $event)
    {
         Notification::create([
            'customer_id' => Auth()->user()->id,
            'message' => 'Your Order Have Been Placed And Will Be Checked',
            'price' => $event->order->final_cash ?? 0
        ]);
    }
}
