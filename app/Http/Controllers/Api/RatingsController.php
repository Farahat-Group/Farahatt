<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rating\RatingRequest;
use App\Models\Rating;
use App\Models\Service;
use App\Services\Rating\ServiceRatingHandler;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    use ApiTraits;


    public function show(Service $service){
        $rating = $service->rating()[0];
        if (!$rating)
            return $this->responseJsonWithoutData(422 , 'No Rating Yet');
        return $this->responseJson(200 , 'Rating Returned' , $rating);
    }


    public function store(Service $service , RatingRequest $request): JsonResponse{
        $rating = $request->rating;
        return (new ServiceRatingHandler)->rateAService($service , $rating);
    }
}
