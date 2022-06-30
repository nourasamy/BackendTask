<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Companies=Company::all();
            return Datatables()->of($Companies)
                ->addIndexColumn() 
                ->addColumn('action',  'company.datatable.actions')
                ->make(true);
        }
        return view('company.index');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        if($request->hasFile('logo'))
        {
            $company= Company::create($request->validated());
            $image      = $request->file('logo');
            $fileName   = $company->id.time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('images/company', $image,$fileName);
            $company->update(['logo'=>$fileName]);
        }
      
        return redirect('company')->withSuccess('company created successfully');
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
        $company=Company::find($id);
        return view('company.edit',['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request,$id)
    {
        $company=Company::find($id);
        $company->update($request->validated());
        if($request->hasFile('logo'))
        {
            Storage::delete('images/company/'.$company->logo);
            $image      = $request->file('logo');
            $fileName   = $id.time() . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('images/company', $image,$fileName);
            $company->update(['logo'=>$fileName]);
        }
        return view('company.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id',$id)->delete();
        return view('employee.index'); 

    }
}
