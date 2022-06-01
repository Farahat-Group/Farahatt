<?php

namespace App\Http\Requests\Api\categories;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    use ApiTraits;
    public function authorize()
    {
        return true;
    }


    public  function rules()
    {
        return [
            'title' => ['required' , Rule::unique('categories' , 'title')->ignore($this->id)],
            'description' => 'required|min:8',
            'image' => 'nullable'

        ];
    }
}
