<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SpecialityRequest;
use App\Models\Category;
use App\Models\Specialty;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SpecialityController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialities=Specialty::all();
        return view('dashboard.speciality.index',compact('specialities'));
    }

    public function changeStatus(Request $request){
        $speciality = Specialty::find($request->spec_id);
        $speciality->active = $request->active;
        $speciality->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        return view('dashboard.speciality.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialityRequest $request)
    {
        $input=$request->except(['category']);
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        if($request->hasFile('icon')){
            $img=$this->uploadImages($request->icon, "uploads/speciality");
            $input['icon']=$img;
        }
        $speciality=  Specialty::create($input);
        $speciality->categories()->attach($request->category);
        return redirect()->route('speciality.index')->withToastSuccess('Speciality Created Successfully!');
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
        $specialty=Specialty::findOrFail($id);
        $category=Category::all();
        return view('dashboard.speciality.edit',compact('specialty','category'));
    }

    public function deleteattachment(Request $request) {
        $record = Specialty::findOrFail($request->id);
        if ($record) {
            if (File::exists($record->icon)) {
                unlink($record->icon);
                $record->icon = '';
                $record->save();
            }
        }
        return response()->json([
            'error' => false,
            'spec'  => $record,
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialityRequest $request, $id)
    {
        $speciality=Specialty::findOrFail($id);
        $input=$request->except(['category']);
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $speciality->update($input);
        if ($request->file("icon")) :
            $img =  $this->uploadImages($request->file("icon"), "uploads/speciality");
            $speciality->update(["icon" => $img]);
        endif;
        if ($request->has("category")) :
            $speciality->categories()->sync($request->category);
        endif;
        return redirect()->route('speciality.index')->withToastSuccess('Speciality Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $speciality=Specialty::findOrFail($id);
        $speciality->categories()->detach();
        $speciality->delete();
        return redirect()->route('speciality.index')->withToastSuccess('Speciality Deleted Successfully!');
    }

    public function massDestroy(Request $request){

        $ids = $request->ids;
        foreach ($ids as $id) {
            $speciality = Specialty::findorfail($id);
            if (File::exists($speciality->icon)) :
                unlink($speciality->icon);
            endif;
            $speciality->categories()->detach();
            $speciality->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }
}
