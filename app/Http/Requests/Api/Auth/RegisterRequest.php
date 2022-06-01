<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\ApiTraits;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
   use ApiTraits;
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required' , Rule::unique('customers' , 'email')],
            'password' => 'required|min:6|max:20',
        ];
    }


}
