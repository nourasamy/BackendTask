<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use App\Events\PostCreated;

class EmployeesController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees=Employee::all();
            foreach($employees as $employee){
                $employee->company_name=Company::where('id',$employee->company)->pluck('name');
            }
            return Datatables()->of($employees)
                ->addIndexColumn() 
                ->addColumn('action',  'employee.datatable.actions')
                ->make(true);
        }
        $companies=Company::all();
        return view('employee.index',['companies'=>$companies]);    
    }
    
    public function filter(Request $request)
    {
            $employees=Employee::where('company',$request->id)->get();
            $company_name=Company::where('id',$request->id)->pluck('name');
            foreach($employees as $employee){
                $employee->company_name=$company_name;
            }
            return Datatables()->of($employees)
                ->addIndexColumn() 
                ->addColumn('action',  'employee.datatable.actions')
                ->make(true);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $companies=Company::all();
        return view('employee.create',['companies'=>$companies]);    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        if($request->hasFile('image'))
        {
            $employee= Employee::create($request->validated());
            $image      = $request->file('image');
            $fileName   = $employee->id.time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('images/employee', $image,$fileName);
            $employee->update(['image'=>$fileName]);
        }
      // event(new PostCreated($employee));
        return view('employee.index');    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee=Employee::find($id);
        $companies=Company::all();
        return view('employee.edit',['employee'=>$employee,'companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee=Employee::find($id);
        $employee->update($request->validated());
        if($request->hasFile('image'))
        {
            Storage::delete('images/employee/'.$employee->image);
            $image      = $request->file('image');
            $fileName   = $id.time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('images/employee', $image,$fileName);
            $employee->update(['image'=>$fileName]);
        }
        return view('employee.index'); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('id',$id)->delete();
        return redirect('employee'); 

    }
}
