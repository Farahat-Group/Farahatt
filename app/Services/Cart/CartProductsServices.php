<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Models\ExtraService;
use App\Models\Service;
use App\Traits\ApiTraits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
//        $exists = self::checkIfItemExistsInCart($id , $cart);
//        if ($exists){
//            $exists->quantity++;
//            $exists->save();
//        } else{
            try {
                \App\Models\CartServices::create([
                    'cart_id' => $cart,
                    'service_id' => $id,
                    'created_at' => Carbon::now()
                ]);
            }catch (\JsonException $e) {
                return $e;
            }


       // }
        return $this->responseJsonWithoutData(200 , 'Added To Cart');

    }

    public function addExtraServiceToCart($id , $cart)
    {

        $service = ExtraService::find($id);
        $parent = $service->service;
        $cart = Cart::where('customer_id' , Auth::user()->id)->first();
        $exists = 0;
        foreach ($cart->services as $s) {
            if ($s['service_id'] == $service['service_id']){
                $exists = 1;
                break;
            }
        }
        if (!$service)
            return $this->responseJsonFailed(422 , 'Extra Service Not Found');
//        $exists = self::checkIfItemExistsInCart($id , $cart);
//        if ($exists){
//            $exists->quantity++;
//            $exists->save();
//        } else{
        try {
            \App\Models\CartServices::create([
                'cart_id' => $cart['id'],
                'service_id' => $id,
                'type' => 1,
                'created_at' => Carbon::now()
            ]);
        }catch (\JsonException $e) {
            return $e;
        }


        // }
        return $this->responseJsonWithoutData(200 , 'Added To Cart');

    }


}
