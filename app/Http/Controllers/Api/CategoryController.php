<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ServiceResource;
use App\Models\Category;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use ApiTraits;
    public function index(): JsonResponse{
        $categories = Category::all();
        if (count($categories) == 0)
            return $this->responseJsonWithoutData(200 , 'No Categories Added Yet !');
        return $this->responseJson(200 , 'Categories Returned' , CategoryResource::collection($categories));
    }

    public function show($id): JsonResponse{
        $category = Category::find($id);
        if (!$category)
            return $this->responseJsonWithoutData(200,'No Category Found !');
        return $this->responseJson(200 , 'Category Returned' , (new CategoryResource($category)));
    }


    public function services(Category $category): JsonResponse
    {
        $services = $category->services;
        if (count($services) == 0)
            return $this->responseJsonWithoutData(200 , 'No Services Found !');
        return $this->responseJson(200 , 'Services Returned' , ServiceResource::collection($services));
    }
}
