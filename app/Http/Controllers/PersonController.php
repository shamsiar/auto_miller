<?php

namespace App\Http\Controllers;

use App\Laravue\Models\Person;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\PersonResource;
use Illuminate\Support\Arr;

class PersonController extends Controller
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
        $personQuery = Person::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $type = Arr::get($searchParams, 'type', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($role)) {
            $personQuery->whereHas('types', function($q) use ($type) { $q->where('name', $type); });
        }

        if (!empty($keyword)) {
            $personQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $personQuery->orWhere('email', 'LIKE', '%' . $keyword . '%');
            $personQuery->orWhere('mobile', 'LIKE', '%' . $keyword . '%');
            $personQuery->orWhere('phone', 'LIKE', '%' . $keyword . '%');
            $personQuery->orWhere('company', 'LIKE', '%' . $keyword . '%');
        }

        return PersonResource::collection($personQuery->paginate($limit));
//        return PersonResource::collection(Person::all());
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
//            [
//                'name' => ['required'],
//                'emp_type' => ['required'],
//            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $person = Person::create( [
                'name' => $params[ 'name' ],
                'email' => $params['email'],
                'mobile' => $params['mobile'],
                'phone' => $params['phone'],
                'company' => $params['company'],
                'address' => $params['address'],
//                'bank_id' => $params['bank_id'],
                'bank_account' => $params['bank_account'],
                'status' => $params['status'],
                'soft_delete' => 0,
//                'email' => $params['email'],
//                'status' => $params[ 'status' ],
            ] );
            $bank = Bank::findByName($params['bank_id']);
            $person->syncBanks($bank);

//            return new UserResource($user);
        }
        return new PersonResource($person);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return new $person;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        if ($person === null) {
            return response()->json(['error' => 'Person not found'], 404);
        }

//        $currentUser = Auth::user();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'emp_type' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $person->name = $params['name'];
            $person->emp_type = $params['emp_type'];
            $person->salary = $params['salary'];
            $person->status = $params['status'];
            $person->save();
        }

        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        try {
            $person->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
