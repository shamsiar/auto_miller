<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankResource;
use App\Laravue\Models\Bank;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Arr;

class BankController extends Controller
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
        $bankQuery = Bank::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        //$role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $bankQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $bankQuery->orWhere('branch', 'LIKE', '%' . $keyword . '%');
            $bankQuery->orWhere('location', 'LIKE', '%' . $keyword . '%');
        }

        return BankResource::collection($bankQuery->paginate($limit));
        //return BankResource::collection(Bank::all());
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
            $bank = Bank::create([
                'name' => $params['name'],
                'branch' => $params['branch'], // Just to make sure this value is unique
                'location' => $params['location'],
                'status' => 1,
            ]);

            return new BankResource($bank);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return new $bank;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        if ($bank === null) {
            return response()->json(['error' => 'Bank not found'], 404);
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
            $bank->name = $params['name'];
            $bank->branch = $params['branch'];
            $bank->location = $params['location'];
            $bank->status = 1;
            $bank->save();
        }

        return new BankResource($bank);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        try {
            $bank->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
