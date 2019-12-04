<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //segment e uma forma de capturar dadas da request na classe de validação request.
        $id = $this->segment(3);
        return [
            'name'         => "required|min:3|max:10|unique:products,name,{$id},id",
            'descripition' => 'max:1000',
            'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'  => 'required|exists:categories,id'
        ];
    }
}
