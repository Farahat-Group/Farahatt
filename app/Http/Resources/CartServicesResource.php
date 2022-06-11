<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class CartServicesResource extends JsonResource
{

    public function toArray($request)
    {
        $service = Service::find($this->service_id);

        return [
            'title' => $service->title,
            'price' => $service->price * $this->quantity,
            'sale' => $service->sale,
            'image' => $service->image,
            'category' => $service->category->title,
            'quantity' => $this->quantity
        ];
    }
}
