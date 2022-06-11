<?php

namespace App\Services\Cart;

use App\Models\Service;
use App\Traits\ApiTraits;
use Carbon\Carbon;

class CartProductsServices
{
use ApiTraits;


public static function checkIfItemExistsInCart($id , $cart) {
    $exists = \App\Models\CartServices::where([
        'cart_id' => $cart,
        'service_id' => $id
    ])->first();
    if ($exists)
        return $exists;
    return false;
}

    public function addServiceToCart($id , $cart)
    {
        $service = Service::find($id);
        if (!$service)
            return $this->responseJsonFailed(422 , 'Service Not Found');
        $exists = self::checkIfItemExistsInCart($id , $cart);
        if ($exists){
            $exists->quantity++;
            $exists->save();
        } else{
            try {
                \App\Models\CartServices::create([
                    'cart_id' => $cart,
                    'service_id' => $id,
                    'created_at' => Carbon::now()
                ]);
            }catch (\JsonException $e) {
                return $e;
            }


        }
        return $this->responseJsonWithoutData(200 , 'Added To Cart');

    }

}
