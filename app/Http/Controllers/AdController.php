<?php

namespace App\Http\Controllers;

use App\Formatters\AdFormatter;
use App\Http\Requests\GetAllAds;
use App\Http\Requests\GetOneAd;
use App\Http\Requests\StoreOneAd;
use App\Models\Ad;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @param GetAllAds $request
     * @param AdFormatter $formatter
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetAllAds $request, AdFormatter $formatter)
    {
        $perPage = 10;
        $ads = Ad::with('links');

        if ($request->get('sort')) {

            $ads = $ads->orderBy($request->get('sort'), $request->get('order') ?? 'asc');
        }
        $ads = $ads
            ->limit($perPage)
            ->offset(($request->get('page') - 1) * $perPage)
            ->get();

        $data = [];
        foreach ($ads as $ad) {

            $data[] = $formatter->format($ad);
        }

        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOneAd $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOneAd $request)
    {
        $newAd = Ad::create($request->all());

        $links = [];
        $requestLinks = $request->get('links');

        for ($i = 0; $i < count($requestLinks); ++$i) {

            $links[] = [
                'link' => $requestLinks[$i],
                'main' => !$i
            ];
        }

        $newAd->links()->createMany($links);

        $data = [
            'type' => 'ad',
            'id' => $newAd->id
        ];

        return response()->json(['data' => $data], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param GetOneAd $request
     * @param AdFormatter $formatter
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GetOneAd $request, AdFormatter $formatter, int $id)
    {
        $ad = Ad::findOrFail($id);

        $attributes = $ad->toArray();
        $data = $formatter->format($ad);

        if ($request->get('fields')) {

            if (in_array('description', $request->get('fields'))) {

                $data['attributes']['description'] = $ad->description;
            }

            if (in_array('links', $request->get('fields'))) {

                $data['attributes']['links'] = $ad->links->pluck('link');
            }
        }

        return response()->json(['data' => $data]);
    }
}
