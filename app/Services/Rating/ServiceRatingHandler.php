<?php

namespace App\Services\Rating;

use App\Models\Rating;
use App\Models\Service;
use App\Traits\ApiTraits;
use Illuminate\Support\Facades\Auth;

class ServiceRatingHandler
{
    use ApiTraits;

    public static function calculateAvgRating( $service): float
    {
        $ratingAvg = $service->rating();
        $collection = [];
        foreach ($ratingAvg as $r) {
            array_push($collection , $r['rating']);
        }
        $ratingAvg = collect($collection)->avg();
        return round( $ratingAvg , 1 , );
    }


    public  function  rateAService($service , $rating ){
        $customer = Auth::user();
        $exists = Rating::query()->whereBelongsTo($customer)->first();
        if (!$exists){
            Rating::create([
                'rating' => $rating,
                'customer_id' => $customer->id,
                'service_id' => $service->id
            ]);
            return $this->responseJsonWithoutData(200 , 'Rating Submitted !');
        } else{
            $exists->update([
                'rating' => $rating
            ]);
            return $this->responseJsonWithoutData(200 , 'Rating Updated !');
        }
    }

}
