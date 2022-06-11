<?php

namespace App\Services\coupon;

use App\Models\Coupon;
use App\Traits\ApiTraits;

class CouponServices
{
use ApiTraits;
    public static function handle(){
        $coupon = \request()->coupon;
        $exists = Coupon::where('coupon' , $coupon)->first(['coupon' , 'status' , 'sale']);
        if (!$exists)
            return 0;
        if ($exists['status'] == 'active')
            return $exists['sale'];
        return 0;

    }

}
