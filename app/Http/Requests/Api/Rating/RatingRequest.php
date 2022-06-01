<?php

namespace App\Http\Requests\Api\Rating;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RatingRequest extends FormRequest
{

    use ApiTraits;

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'rating' => 'required|between:1,10'
        ];
    }

    public function messages()
    {
         return [
            'rating.*' => 'Rating Is Required And Must Be Between 1 To 5'
        ];
    }
}
