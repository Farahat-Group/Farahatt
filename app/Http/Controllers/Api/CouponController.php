<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\coupon\CouponServices;
use App\Traits\ApiTraits;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use ApiTraits;

    public function submit(){
        return CouponServices::handle();
    }

    public function check(Request $request) {
        $coupon = $request['coupon'];
        $check = Coupon::where('coupon' , $coupon)->first();
        if (!$check)
            return $this->responseJsonFailed(422 , 'coupon incorrect');
        if ($check->status == 'active')
            return $this->responseJson(200 ,'Coupon Is Correct And Sale Returned' , $check->sale);

        return $this->responseJsonFailed(422 , 'coupon expired');


    }

    public function index() {
        $coupons = Coupon::all();
        return view('coupons.index' , [
            'coupons' => Coupon::all()
        ]);
    }

    public function create() {
        return view('coupons.create');
    }

    public function store(Request $request , FlasherInterface $flasher) {
        $request->validate([
            'coupon' => 'required',
            'sale' => 'required'
        ]);
        Coupon::create($request->all());
        $flasher->addSuccess('Coupon Created');
        return redirect()->route('coupon.index');
    }
    public function destroy($id , FlasherInterface $flasher) {
        Coupon::find($id)->delete();
        $flasher->addDeleted('Coupon');
        return redirect()->back();

    }

}
