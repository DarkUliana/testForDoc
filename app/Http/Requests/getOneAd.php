<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getOneAd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'fields.*' => 'string|in_array:description,links|distinct'
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['fields'] = $this->route('fields');
        return $data;
    }
}
