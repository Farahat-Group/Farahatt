<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use ApiTraits;

    public function submit(): JsonResponse{
        $coupon = \request()->coupon;
        $exists = Coupon::where('coupon' , $coupon)->first(['coupon' , 'status' , 'sale']);
        if (!$exists)
            return $this->responseJsonWithoutData(422 , "Coupon Is Incorrect");
        if ($exists['status'] == 'active')
            return $this->responseJson(200 , 'Coupon Sale Returned' , $exists['sale']);
        return $this->responseJsonFailed(422 , 'Coupon Is Expired');

    }
}
