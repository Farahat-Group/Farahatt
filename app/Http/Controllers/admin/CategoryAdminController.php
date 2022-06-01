<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\categories\CategoryStoreRequest;
use App\Http\Requests\Api\categories\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class CategoryAdminController extends Controller
{
    use ApiTraits;
    public function index(){
        $categories = Category::all();
        if (count($categories) == 0)
            return $this->responseJsonWithoutData(200 , 'No Categories Added Yet !');
        return $this->responseJson(200 , 'Categories Returned' , CategoryResource::collection($categories));
    }

    public function show($id){
        $category = Category::find($id);
        if (!$category)
            return $this->responseJsonWithoutData(200,'No Category Found !');
        return $this->responseJson(200 , 'Category Returned' , (new CategoryResource($category)));
    }

    public function store(CategoryStoreRequest $request): JsonException|JsonResponse|\Exception
    {
        try {
            $category = Category::create($request->all());
            return $this->responseJson(200 , "Category Created" , (new CategoryResource($category)));
        }catch (JsonException $e) {
            return $e;
        }
    }





}
