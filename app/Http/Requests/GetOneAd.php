<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetOneAd extends FormRequest
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
            'fields' => 'array',
            'fields.*' => 'string'
        ];
    }

    public function all($keys = null)
    {
        return $this->input();
    }
}
