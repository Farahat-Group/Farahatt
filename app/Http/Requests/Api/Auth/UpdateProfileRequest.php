<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    use  ApiTraits;
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
            'name' => 'nullable',
            'email' => ['nullable' , Rule::unique('customers' , 'email')->ignore(Auth::user()->id)],
            'image' => 'nullable',
        ];
    }
}
