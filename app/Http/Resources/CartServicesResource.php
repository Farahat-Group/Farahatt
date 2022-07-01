<?php

namespace App\Http\Resources;

use App\Models\Cart;
use App\Models\CartServices;
use App\Models\ExtraService;
use App\Models\Service;
use App\Models\ServiceImages;
use App\Services\Rating\ServiceRatingHandler;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartServicesResource extends JsonResource
{

    public function toArray($request)
    {
        $service = Service::find($this->service_id);

        $service->ratingAvg = ServiceRatingHandler::calculateAvgRating($service);
        $images = ServiceImages::where('service_id' , $service->id)->get('image');
        $photos = [];
        foreach ($images as $image){
            array_push($photos , url('images/services/'.$image->image));
        }

        $extraIds = Cart::where('customer_id' , Auth::user()->id)->first()->extra_services();
        $extras = new Collection();
        foreach ($extraIds as $e) {
            if ($e->service_id == $service['id']) {
                $extras->push(ExtraService::find($e['service_id'])->get(['id' , 'title' , 'price']));
            }
        }



        return [
            'id' => $this->id,
            'title' => $service->title,
            'service_id' => $service->id,
            'description' => $service->description,
            'main_image' => $service->images ? url('images/services/' . $service->images)  : "No Image",
            'extra_images' => $photos,
            'price' =>(double)$service->price,
            'sale' => (double)$service->sale,
            'price_after_sale' => (double)$service->priceAfterSale,
            'rating' =>(double) $service->ratingAvg,
            'extra_services' => $extras[0] ,
            'service_code' => $service->service_code,
            'category' =>  (new CategoryResource($service->category)),
        ];

    }
}
