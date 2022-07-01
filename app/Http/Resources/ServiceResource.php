<?php

namespace App\Http\Resources;

use App\Models\ExtraService;
use App\Models\ServiceImages;
use App\Services\Rating\ServiceRatingHandler;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{



    public function toArray($request)
    {



         $this->ratingAvg = ServiceRatingHandler::calculateAvgRating($this);
        $images = ServiceImages::where('service_id' , $this->id)->get('image');
        $photos = [];
        foreach ($images as $image){
            array_push($photos , url('images/services/'.$image->image));
        }


        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'main_image' => $this->images ? url('images/services/' . $this->images)  : "No Image",
            'extra_images' => $photos,
            'price' =>(double)$this->price,
            'sale' => (double)$this->sale,
            'price_after_sale' => (double)$this->priceAfterSale,
            'rating' =>(double) $this->ratingAvg,
            'service_code' => $this->service_code,
            'service_id' => $this->id,
            'extra_services' => ExtraServiceResource::collection($this->extraServices),
            'category' =>  (new CategoryResource($this->category)),
        ];
    }
}
