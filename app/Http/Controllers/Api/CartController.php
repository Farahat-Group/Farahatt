<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartServicesResource;
use App\Models\Cart;
use App\Services\Cart\CartProductsServices;
use App\Services\Cart\CartServices;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiTraits;
    public function addToCart($id){
        $cart = CartServices::checkIfCartExists();
        if (!$cart){
            $cart = CartServices::addNewCart();
        }
        return (new CartProductsServices())->addServiceToCart($id , $cart['id']);
    }

    public function index() {
        $cart = Cart::where('customer_id' , Auth::user()->id)->first();
        if ($cart)
            return $this->responseJson(200 , 'Cart Returned' , CartServicesResource::collection($cart->services));
        return $this->responseJsonFailed(422 , 'Cart is Empty');
    }

    public function decrease($id) {
        $cart = Cart::where('customer_id' , Auth::user()->id)->first();
        $exists = CartProductsServices::checkIfItemExistsInCart($id , $cart['id']);
        if (!$exists)
            return $this->responseJsonFailed(422 , 'Item Is Not In The Cart');

        if ($exists->quantity == 1){
            $exists->delete();
            return $this->responseJsonWithoutData(200 , 'deleted');
        }
        $exists->quantity--;
        $exists->save();
        return $this->responseJsonWithoutData(200 , 'Done');
    }

    public function destroy() {
        Cart::where('customer_id' , Auth::user()->id)->delete();
        return $this->responseJsonWithoutData(200 , 'Cart Cleared');
    }
}
