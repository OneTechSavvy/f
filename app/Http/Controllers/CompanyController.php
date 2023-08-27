<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Requests\StoreComapnyRequest;
use App\Http\Requests\UpateCompanyRequest;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::paginate(10);
        return Inertia::render('Companies/Index', compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComapnyRequest $request)
    {
        $newCompany = $request->validated();
        $fileName = time().'.'.$request->logo->extension();  
        $request->logo->move(public_path('storage/logo'), $fileName);
        $newCompany["logo"] = $fileName;
        Company::create($newCompany);

        return redirect('companies');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Companies/Create');
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
        $company = new CompanyResource(Company::find($id));
        return Inertia::render('Companies/Edit', compact("company"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpateCompanyRequest $request, $id)
    {
        Company::find($id)->update($request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::find($id)->delete();
        return back();
    }

    public function getList()
    {
        return CompanyResource::collection(Company::all());
    }

}
