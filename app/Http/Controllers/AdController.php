<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use http\Env\Response;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $ads = Ad::with('links');

        if ($request->get('sort')) {

            $ads = $ads->orderBy($request->get('sort'), $request->get('order') ?? 'asc');
        }
        $ads = $ads
            ->limit($perPage)
            ->offset($request->get('page') * $perPage)
            ->get();

        $data = [];
        foreach ($ads as $ad) {

            $data[] = [
                'type' => 'ad',
                'id' => $ad->id,
                'attributes' => [
                    'name' => $ad->name,
                    'price' => $ad->price,
                    'link' => $ad->links->where('main', true)->column('link')
                ]
            ];
        }

        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newAd = Ad::create($request->all(['name', 'price', 'description']));
        $newAd->links()->createMany($request->get('links'));

        $data = [
            'type' => 'ad',
            'id' => $newAd->id
        ];

        return response()->json(['data' => $data], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
