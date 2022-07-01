<?php

namespace App\Http\Resources;

use App\Models\ExtraService;
use App\Models\Service;
use App\Models\ServiceImages;
use App\Services\Rating\ServiceRatingHandler;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderExtraSerivesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $service = ExtraService::find($this['service_id']);


        return [
            'id' => $this->id,
            'title' => $service->title,
            'description' => $service->description,
            'main_image' => $service->images ? url('images/services/' . $service->images)  : "No Image",
            'price' =>(double)$service->price,
            'sale' => (double)$service->sale,
            'price_after_sale' => (double)$service->priceAfterSale,
            'service_code' => $service->service_code,
            'service_id' => $service->id,
        ];
    }
}
