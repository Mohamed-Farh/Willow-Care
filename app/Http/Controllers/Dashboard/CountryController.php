<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Http\Requests\Dashboard\CountryRequest;
use App\Models\Category;
use App\Models\Country;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CountryController extends Controller
{
    use HelperTrait;
   public function index(){
       $countries=Country::all();
       return view('dashboard.country.index',compact('countries'));
   }

    public function changeStatus(Request $request){
        $country = Country::find($request->country_id);
        $country->active = $request->active;
        $country->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function massDestroy(Request $request){

        $ids = $request->ids;
        foreach ($ids as $id) {
            $country = Country::findorfail($id);
            if (File::exists($country->flag)) :
                unlink($country->flag);
            endif;
            $country->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }

    public function create(){
        return view('dashboard.country.create');
    }

    public function store(CountryRequest $request){
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        if($request->hasFile('flag')){
            $img=$this->uploadImages($request->flag, "uploads/country");
            $input['flag']=$img;
        }
        Country::create($input);

        return redirect()->route('countries.index')->withToastSuccess('Country Created Successfully!');
    }

    public function edit(Country $country)
    {
        return view('dashboard.country.edit',compact('country'));
    }


    public function deleteattachment(Request $request) {
        $record = Country::findOrFail($request->id);
        if ($record) {
            if (File::exists($record->flag)) {
                unlink($record->flag);
                $record->flag = null;
                $record->save();
            }
        }
        return response()->json([
            'error' => false,
            'country'  => $record,
        ], 200);

    }


    public function update(CountryRequest $request, Country $country)
    {
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $country->update($input);
        if ($request->file("flag")) :
            $img =  $this->uploadImages($request->file("flag"), "uploads/country");
            $country->update(["flag" => $img]);
        endif;
        return redirect()->route('countries.index')->withToastSuccess('Country Updated Successfully!');


    }

    public function destroy(Country $country)
    {
        if (File::exists($country->flag)) :
            unlink($country->flag);
        endif;
        $country->delete();
        return redirect()->route('countries.index')->withToastSuccess('Country Deleted Successfully!');
    }
}
