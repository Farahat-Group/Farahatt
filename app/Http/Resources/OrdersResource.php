<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'order_id' => $this->id,
            'order_price' => $this->cash,
            'order_status' => $this->status,
            "order_sale" => $this->sale,
            "order_final_price" => $this->final_cash,
            'payment_method' => $this->payment_mathod ?? 'cash'
        ];
    }
}
