<?php

namespace App\Http\Controllers;

use App\Models\company;

use App\Models\user;

use Illuminate\Http\Request;

use App\Http\Requests\Companies\CreateCompanyRequest;

use App\Http\Requests\Companies\UpdateCompanyRequest;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('project.index')->with('companies', Company::paginate(5));
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
    public function store(CreateCompanyRequest  $request)
    {
        Company :: create([

            'name' => $request->name

        ]);

        session()->flash('success' , 'Company Created Successfully');

        return view('project.companies')->with('companies', Company::orderBy('name', 'ASC')->get())->with('users',User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
       return view('project.CompUpdt')->with('company', $company)->with('companies', Company::all())->with('users', User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->name = $request->name;

        $company->save();

        session()->flash('success' , 'Company Updated Successfully');

        return view('project.companies')->with('companies', Company::orderBy('name', 'ASC')->get())->with('users', User::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        session()->flash('success', 'company deleted successfully');

        return view('project.companies')->with('companies', Company::orderBy('name', 'ASC')->get())->with('users', User::all());

    }

    public function view()
    {
        return view('project.companies')->with('companies', Company::orderBy('name', 'ASC')->get())->with('users', User::all());
    }
}
