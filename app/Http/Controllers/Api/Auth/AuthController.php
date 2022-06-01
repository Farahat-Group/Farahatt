<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ProfileResource;
use App\Models\Customer;
use App\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class AuthController extends Controller
{
    use ApiTraits;


    public function login(loginRequest $request): JsonResponse
    {
        $customer = Customer::query()->where([
            'email' => $request->email,
        ])->first();
        if (!$customer)
            return $this->responseJsonWithoutData(200, 'Invalid Email Address');

        if (!Hash::check($request->password , $customer->password)){
            return $this->responseJsonWithoutData(200 , 'No User Found');        }
       $customer->token = $customer->createToken('token')->accessToken;
       return $this->responseJson(200, 'Logged In Successfully' , (new CustomerResource($customer)));
    }

    public function register(RegisterRequest $request): JsonException|JsonResponse|\Exception
    {
        try {
            $customer = Customer::create($request->all());
            $customer->token = $customer->createToken('token')->accessToken;
            return $this->responseJson(200, 'Account Created Successfully' , (new CustomerResource($customer)));
        } catch (JsonException $e){
            return $e;
        }
    }

    public function getProfile(): JsonResponse
    {
       return $this->responseJson(200 ,'Profile Returned' , (new ProfileResource(Auth::user())));
    }

    public function updateProfile(UpdateProfileRequest $request) {
        try {
            $customer = Auth::user();
            $exception = ['created_at' , 'image'];

            foreach ($request->all() as $key => $value){
                if ($value == null){
                    array_push($exception , $key);
                    break;
                }
            }

            if ($request->hasFile('image')){
                array_pop($exception );
                $image = $request->file('image');
                $new_name = time() . $image->getClientOriginalName();
                $image->move(public_path('/images/employee/profile'), $new_name);
                $request->image = $new_name;
            }
            $customer->update($request->except($exception));
            return $this->responseJsonWithoutData(200 , 'Profile Updated');

        } catch (JsonException $e){
            return $this->responseJsonFailed(422 , 'Failed');
        }

    }
}
