<?php

namespace App\Http\Resources;

use App\Services\Rating\ServiceRatingHandler;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{



    public function toArray($request)
    {



        $this->ratingAvg = ServiceRatingHandler::calculateAvgRating($this);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->images ?? "No Images",
            'price' =>(double)$this->price,
            'sale' => (double)$this->sale,
            'rating' =>(double) $this->ratingAvg,
            'service_code' => $this->service_code,
            'category' =>  (new CategoryResource($this->category)),
        ];
    }
}
