<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getAllAds extends FormRequest
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
            'page' => 'number',
            'sort' => 'string|in_array:price,date',
            'oder' => 'string|in_array:asc,desc',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['sort'] = $this->route('sort');
        $data['order'] = $this->route('order');
        $data['page'] = $this->route('page');
        return $data;
    }
}
