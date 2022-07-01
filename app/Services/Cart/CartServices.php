<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Models\ExtraService;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use JsonException;

class CartServices
{

    public static function checkIfCartExists(): object|bool // Return Cart If There Is Cart In Database
    {
        $cart = Cart::query()->where('customer_id' , Auth::user()->id)->first();
        if ($cart)
            return $cart;
        return false;
    }

    public static function addNewCart()
    {
        try {
            return Cart::create([
                'customer_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } catch (JsonException $e) {
            return $e;
        }

    }

    public static function getCartTotalCash() {
        $cash = 0;
        $cart = Cart::where('customer_id',Auth::user()->id)->first();
        foreach ($cart->services as $service){
                $s =  Service::query()->where('id' , $service['service_id'])->first();
                $cash += $s['priceAfterSale'];
        }

        return $cash;
    }

    public static function getExtrasCash() {
        $cash = 0;
        $cart = Cart::where('customer_id',Auth::user()->id)->first();
        foreach ($cart->extra_services() as $service){
            $s =  ExtraService::query()->where('id' , $service['service_id'])->first();
            $cash += $s['priceAfterSale'];
        }

        return $cash;
    }



}
