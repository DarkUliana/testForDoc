<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOneAd extends FormRequest
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
        return [
            'name' => 'required|string|max:200',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999999',
            'links' => 'required|array|min:1|max:3',
            'links.*' => 'string|max:2048'
        ];
    }

    public function all($keys = null)
    {
        return parent::json()->all($keys);
    }
}
