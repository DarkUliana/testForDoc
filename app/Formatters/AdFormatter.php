<?php


namespace App\Formatters;

use App\Models\Ad;

class AdFormatter
{
    public function format(Ad $ad): array
    {
        return [
            'type' => 'ad',
            'id' => $ad->id,
            'attributes' => [
                'name' => $ad->name,
                'price' => $ad->price,
                'main_link' => $ad->links->where('main', true)->first()->link
            ]
        ];
    }
}
