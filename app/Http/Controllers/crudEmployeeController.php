<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laravue\Models\Employee;


/**
 * Description of EmployeeController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */

class EmployeeController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.employees.index', ['records' => Employee::paginate(10)]);
    }    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employee $employee)
    {
        return view('pages.employees.show', [
                'record' =>$employee,
        ]);

    }    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('pages.employees.create', [
            'model' => new Employee,

        ]);
    }    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model=new Employee;
        $model->fill($request->all());

        if ($model->save()) {
            
            session()->flash('app_message', 'Employee saved successfully');
            return redirect()->route('employees.index');
            } else {
                session()->flash('app_message', 'Something is wrong while saving Employee');
            }
        return redirect()->back();
    } /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Employee $employee)
    {

        return view('pages.employees.edit', [
            'model' => $employee,

            ]);
    }    /**
     * Update a existing resource in storage.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employee $employee)
    {
        $employee->fill($request->all());

        if ($employee->save()) {
            
            session()->flash('app_message', 'Employee successfully updated');
            return redirect()->route('employees.index');
            } else {
                session()->flash('app_error', 'Something is wrong while updating Employee');
            }
        return redirect()->back();
    }    /**
     * Delete a  resource from  storage.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Employee $employee)
    {
        if ($employee->delete()) {
                session()->flash('app_message', 'Employee successfully deleted');
            } else {
                session()->flash('app_error', 'Error occurred while deleting Employee');
            }

        return redirect()->back();
    }
}
