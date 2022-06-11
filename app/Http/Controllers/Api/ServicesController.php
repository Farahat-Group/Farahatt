<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ServiceResource;
use App\Models\Category;
use App\Models\Service;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ServicesController extends Controller
{
    use ApiTraits;

    private Collection $services;
    public function index(): JsonResponse{
        $this->services = Service::filter();
        if (count($this->services) == 0)
            return $this->responseJsonWithoutData(200 , 'No Services Found!');
        return $this->responseJson(200 , 'Services Returned' , ServiceResource::collection($this->services));
    }

    public function show($id): JsonResponse{
        $service = Service::find($id);
        if (!$service)
            return $this->responseJsonWithoutData(200,'No Service Found !');
        return $this->responseJson(200 , 'Service Returned' , (new ServiceResource($service)));
    }


    public function bestsellers(): JsonResponse{
        $this->services = Service::query()->orderBy('sales' , 'desc')->take(10)->get();
        if (count($this->services) == 0)
            return $this->responseJsonWithoutData(200 , 'No Services Found!');
        return $this->responseJson(200 , 'Services Returned' , ServiceResource::collection($this->services));
    }

    public function newServices(): JsonResponse{
        $this->services = Service::query()->latest()->get()->sortByDesc('id');
        if (count($this->services) == 0)
            return $this->responseJsonWithoutData(200 , 'No Services Found!');
        return $this->responseJson(200 , 'Services Returned' , ServiceResource::collection($this->services));
    }
}
