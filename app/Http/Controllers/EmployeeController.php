<?php

namespace App\Http\Controllers;

use App\Laravue\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Arr;

class EmployeeController extends Controller
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
        $employeeQuery = Employee::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        //$role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $employeeQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $employeeQuery->orWhere('emp_type', 'LIKE', '%' . $keyword . '%');
            $employeeQuery->orWhere('salary', 'LIKE', '%' . $keyword . '%');
        }

        return EmployeeResource::collection($employeeQuery->paginate($limit));
//        return EmployeeResource::collection(Employee::all());
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
                'emp_type' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $employee = Employee::create( [
                'name' => $params[ 'name' ],
                'emp_type' => $params[ 'emp_type' ], // Just to make sure this value is unique
                'salary' => $params[ 'salary' ],
                'status' => $params[ 'status' ],
            ] );
        }
            return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return new $employee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        if ($employee === null) {
            return response()->json(['error' => 'Employee not found'], 404);
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
            $employee->name = $params['name'];
            $employee->emp_type = $params['emp_type'];
            $employee->salary = $params['salary'];
            $employee->status = $params['status'];
            $employee->save();
        }

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }
}
