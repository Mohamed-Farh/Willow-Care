<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfessionalTitleRequest;
use App\Models\Category;
use App\Models\ProfessionalTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfessionalTitleController extends Controller
{
    public function index()
    {
        $titles=ProfessionalTitle::all();
        return view('dashboard.professional-title.index',compact('titles'));
    }

    public function create()
    {
        return view('dashboard.professional-title.create');
    }

    public function store(ProfessionalTitleRequest $request){
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        ProfessionalTitle::create($input);
        return redirect()->route('prof-title.index')->withToastSuccess('Title Created Successfully!');
    }

    public function edit($id){

        $professionalTitle=ProfessionalTitle::findOrFail($id);
        return view('dashboard.professional-title.edit',compact('professionalTitle'));
    }

    public function update(ProfessionalTitleRequest $request, $id)
    {
        $professionalTitle=ProfessionalTitle::findOrFail($id);
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $professionalTitle->update($input);
        return redirect()->route('prof-title.index')->withToastSuccess('Title Updated Successfully!');


    }

    public function massDestroy(Request $request){

        $ids = $request->ids;
        foreach ($ids as $id) {
            $title = ProfessionalTitle::findorfail($id);
            $title->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }

    public function changeStatus(Request $request){
        $title = ProfessionalTitle::find($request->title_id);
        $title->active = $request->active;
        $title->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function destroy($id) {

        $professionalTitle=ProfessionalTitle::findOrFail($id);
        $professionalTitle->delete();
        return redirect()->route('prof-title.index')->withToastSuccess('Title Deleted Successfully!');
    }
}
