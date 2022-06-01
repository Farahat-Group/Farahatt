<?php

namespace App\Http\Requests\Api\categories;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
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
            'title' => ['required' , Rule::unique('categories' , 'title' )],
            'description' => 'required|min:8',
            'image' => 'nullable'
        ];
    }

}
