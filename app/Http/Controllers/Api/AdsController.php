<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdsResource;
use App\Models\Ads;
use App\Traits\ApiTraits;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller{
    use ApiTraits;


    public function index() {
        $ads = Ads::all();
        return $this->responseJson(200 , 'Ads Returned' , AdsResource::collection($ads));
    }
}
