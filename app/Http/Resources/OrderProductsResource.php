<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductsResource extends JsonResource
{

    public function toArray($request)
    {
        $service = Service::find($this['service_id']);
        return [
            'title' => $service->title,
            'price' => $service->price,
            'sale' => $service->sale,
            'priceAfterSale' => $service->priceAfterSale,
            'quantity' => $this->quantity,
        ];
    }
}
