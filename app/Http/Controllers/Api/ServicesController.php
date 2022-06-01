<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ServiceResource;
use App\Models\Category;
use App\Models\Service;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    use ApiTraits;
    public function index(): JsonResponse{
        $services = Service::filter();
        if (count($services) == 0)
            return $this->responseJsonWithoutData(200 , 'No Services Found!');
        return $this->responseJson(200 , 'Services Returned' , ServiceResource::collection($services));
    }

    public function show($id): JsonResponse{
        $service = Service::find($id);
        if (!$service)
            return $this->responseJsonWithoutData(200,'No Service Found !');
        return $this->responseJson(200 , 'Service Returned' , (new ServiceResource($service)));
    }

    public function bestsellers() {
        $services = Service::query()->orderBy('sales' , 'desc')->take(10)->get();
        if (count($services) == 0)
            return $this->responseJsonWithoutData(200 , 'No Services Found!');
        return $this->responseJson(200 , 'Services Returned' , ServiceResource::collection($services));
    }
}
