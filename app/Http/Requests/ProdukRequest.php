<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    // public function messages()
    // {

    // }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'categories_id' => [
                'required',
                'interger'
            ],
            'description' => [
                'required',
                'string'
            ],
            'price' => [
                'required',
                'interger'
            ],
            'price' => [
                'required',
                'interger'
            ],
            // 'url' => [
            //     'required',
            //     'string'
            // ],
        ];
    }

}
