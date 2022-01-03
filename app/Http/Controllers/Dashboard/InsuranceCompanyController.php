<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\InsuranceCompanyRequest;
use App\Models\Category;
use App\Models\InsuranceCompany;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InsuranceCompanyController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=InsuranceCompany::all();
        return view('dashboard.insurance-company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.insurance-company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsuranceCompanyRequest $request)
    {
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        if($request->hasFile('image')){
            $img=$this->uploadImages($request->image, "uploads/company");
            $input['image']=$img;
        }
        InsuranceCompany::create($input);

        return redirect()->route('insurance-company.index')->withToastSuccess('Insurance Company Created Successfully!');
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
    public function edit(InsuranceCompany $insuranceCompany)
    {
        return view('dashboard.insurance-company.edit',compact('insuranceCompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsuranceCompanyRequest $request, InsuranceCompany $insuranceCompany)
    {

        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $insuranceCompany->update($input);
        if ($request->file("image")) :
            $img =  $this->uploadImages($request->file("image"), "uploads/company");
            $insuranceCompany->update(["image" => $img]);
        endif;
        return redirect()->route('insurance-company.index')->withToastSuccess('Insurance Company Updated Successfully!');
    }



    public function changeStatus(Request $request){
        $company = InsuranceCompany::find($request->company_id);
        $company->active = $request->active;
        $company->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function deleteattachment(Request $request) {
        $record = InsuranceCompany::findOrFail($request->id);
        if ($record) {
            if (File::exists($record->image)) {
                unlink($record->image);
                $record->image = null;
                $record->save();
            }
        }
        return response()->json([
            'error' => false,
            'company'  => $record,
        ], 200);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsuranceCompany $insuranceCompany)
    {
        if (File::exists($insuranceCompany->image)) :
            unlink($insuranceCompany->image);
        endif;
        $insuranceCompany->delete();
        return redirect()->route('insurance-company.index')->withToastSuccess('Insurance Company Deleted Successfully!');
    }

    public function massDestroy(Request $request){

        $ids = $request->ids;
        foreach ($ids as $id) {
            $company = InsuranceCompany::findorfail($id);
            if (File::exists($company->image)) :
                unlink($company->image);
            endif;
            $company->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }
}
