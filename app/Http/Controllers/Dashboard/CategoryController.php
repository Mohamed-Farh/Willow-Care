<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use App\Models\Country;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        if($request->hasFile('image')){
            $img=$this->uploadImages($request->image, "uploads/category");
            $input['image']=$img;
        }
        Category::create($input);

        return redirect()->route('categories.index')->withToastSuccess('Category Created Successfully!');

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
    public function edit(Category $category)
    {
       return view('dashboard.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function deleteattachment(Request $request) {
        $record = Category::findOrFail($request->id);
        if ($record) {
            if (File::exists($record->image)) {
                unlink($record->image);
                $record->image = null;
                $record->save();
            }
        }
        return response()->json([
            'error' => false,
            'category'  => $record,
        ], 200);

    }


    public function update(CategoryRequest $request, Category $category)
    {
        $input=$request->all();
        $input['active']=$request->input('active') == TRUE ?"1":"0";
        $category->update($input);
        if ($request->file("image")) :
            $img =  $this->uploadImages($request->file("image"), "uploads/category");
            $category->update(["image" => $img]);
        endif;
        return redirect()->route('categories.index')->withToastSuccess('Category Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (File::exists($category->image)) :
            unlink($category->image);
        endif;
         $category->delete();
        return redirect()->route('categories.index')->withToastSuccess('Category Deleted Successfully!');
    }

    public function massDestroy(Request $request){

        $ids = $request->ids;
        foreach ($ids as $id) {
            $category = Category::findorfail($id);
            if (File::exists($category->image)) :
                unlink($category->image);
            endif;
            $category->delete();
        }
        return response()->json([
            'error' => false,
        ], 200);

    }

    public function changeStatus(Request $request){
        $category = Category::find($request->cat_id);
        $category->active = $request->active;
        $category->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
