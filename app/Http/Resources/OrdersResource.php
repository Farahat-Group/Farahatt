<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'order_id' => $this->id,
            'order_price' => $this->cash,
            'order_status' => $this->status,
            "order_sale" => $this->sale,
            "order_extras" => $this->extras,
            "order_final_price" => $this->final_cash,
            'payment_method' => $this->payment_method,
            'payment_code' => $this->payment_code ?? 'Cash',
            'coupon' => $this->coupon,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
