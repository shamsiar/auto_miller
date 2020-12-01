<?php

namespace App\Http\Controllers;

use App\Http\Resources\GodownResource;

use App\Laravue\Models\Godown;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Arr;
class GodownController extends Controller
{
    const ITEM_PER_PAGE = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $godownQuery = Godown::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        //$role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $godownQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $godownQuery->orWhere('branch', 'LIKE', '%' . $keyword . '%');
            $godownQuery->orWhere('location', 'LIKE', '%' . $keyword . '%');
        }

        return GodownResource::collection($godownQuery->paginate($limit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'branch' => ['required'],
                'location' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $godown = Godown::create([
                'name' => $params['name'],
                'branch' => $params['branch'], // Just to make sure this value is unique
                'location' => $params['location'],
                'status' => 1,
            ]);

            return new GodownResource($godown);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\Models\Godown  $godown
     * @return \Illuminate\Http\Response
     */
    public function show(Godown $godown)
    {
        return new $godown;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\Models\Godown  $godown
     * @return \Illuminate\Http\Response
     */
    public function edit(Godown $godown)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\Models\Godown  $godown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Godown $godown)
    {
        if ($godown === null) {
            return response()->json(['error' => 'Godown not found'], 404);
        }

//        $currentUser = Auth::user();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'branch' => ['required'],
                'location' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $godown->name = $params['name'];
            $godown->branch = $params['branch'];
            $godown->location = $params['location'];
            $godown->status = 1;
            $godown->save();
        }

        return new GodownResource($godown);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\Models\Godown  $godown
     * @return \Illuminate\Http\Response
     */
    public function destroy(Godown $godown)
    {
        try {
            $godown->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
