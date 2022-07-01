<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartExtraServiceResource;
use App\Http\Resources\CartServicesResource;
use App\Models\Cart;
use App\Models\ExtraService;
use App\Services\Cart\CartProductsServices;
use App\Services\Cart\CartServices;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiTraits;
    public function addToCart($id){
        $cart = CartServices::checkIfCartExists();
        if (!$cart){
            $cart = CartServices::addNewCart();
        }
        if (\request()->has('extra_service_id')) {
           (new CartProductsServices())->addExtraServiceToCart(\request('extra_service_id') , $cart['id']);
        }
        return (new CartProductsServices())->addServiceToCart($id , $cart['id']);
    }

    public function addExtraToCart($id){
        $cart = CartServices::checkIfCartExists();
        if (!$cart){
            return $this->responseJsonWithoutData(200 , 'Cart Is Empty');
        }
        $exists = 0;
        foreach ($cart->services as $service) {
            if ($service['service_id'] == $id){
                $exists = 1;
            }
        }

        if ($exists)
            return (new CartProductsServices())->addExtraServiceToCart($id , $cart['id']);

        return $this->responseJsonWithoutData(200 , 'Parent Service Is Not In The Cart');

    }

    public function index() {
        $cart = Cart::where('customer_id' , Auth::user()->id)->first();
        if ($cart){
            $extraIds = $cart->extra_services();
        $extras = new Collection();
        foreach ($extraIds as $e) {
            $extras->push(ExtraService::find($e['service_id']));
        }
            return $this->responseJson(200 , 'Cart Returned' , CartServicesResource::collection($cart->services));
        }


        return $this->responseJsonFailed(200 , 'Cart is Empty');
    }

//    public function decrease($id) {
//        $cart = Cart::where('customer_id' , Auth::user()->id)->first();
//        $exists = CartProductsServices::checkIfItemExistsInCart($id , $cart['id']);
//        if (!$exists)
//            return $this->responseJsonFailed(422 , 'Item Is Not In The Cart');
//
//        if ($exists->quantity == 1){
//            $exists->delete();
//            return $this->responseJsonWithoutData(200 , 'deleted');
//        }
//        $exists->quantity--;
//        $exists->save();
//        return $this->responseJsonWithoutData(200 , 'Done');
//    }

    public function removeItem($id): JsonResponse
    {
        $cartItem = \App\Models\CartServices::find($id);
        if($cartItem){
            try {
                $item = $cartItem->delete();
                return $this->responseJsonWithoutData(200 , 'Item Removed From Cart');
            }catch (\JsonException $e) {
                return $this->responseJsonFailed(422 , 'Failed');
            }
        }
        return $this->responseJsonFailed(422 , 'No Item Found');
    }


    public function destroy() {
        Cart::where('customer_id' , Auth::user()->id)->delete();
        return $this->responseJsonWithoutData(200 , 'Cart Cleared');
    }
}
