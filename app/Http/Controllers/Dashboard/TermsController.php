<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TermsRequest;
use App\Models\Category;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $terms=Term::all();
       return view('dashboard.terms.index',compact('terms'));
    }



    public function changeStatus(Request $request){
        $term = Term::find($request->term_id);
        $term->active = $request->active;
        $term->save();
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
        return view('dashboard.terms.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TermsRequest $request)
    {
        $input=$request->except('category');
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $input['category_id']=$request->category;
        Term::create($input);
        return redirect()->route('terms.index')->withToastSuccess('Terms Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        return view('dashboard.terms.show',compact('term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        $category=Category::all();
        return view('dashboard.terms.edit',compact('term','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TermsRequest $request, Term $term)
    {

        $input=$request->except('category');
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $input['category_id']=$request->category;
        $term->update($input);
        return redirect()->route('terms.index')->withToastSuccess('Terms Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $term->delete();
        return redirect()->route('terms.index')->withToastSuccess('Terms Deleted Successfully!');
    }

    public function massDestroy(Request $request){

        $ids = $request->ids;
        foreach ($ids as $id) {
            $term = Term::findorfail($id);
            $term->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }
}
