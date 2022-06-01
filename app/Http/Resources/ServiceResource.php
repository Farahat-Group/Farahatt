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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->images ?? "No Images",
            'price' =>$this->price . '$',
            'sale' => $this->sale == 0 ? "No Sale" : $this->sale,
            'rating' => $this->ratingAvg ?? "No Rating Yet",
            'category' => $this->category->get(['id' , 'title']),
        ];
    }
}
