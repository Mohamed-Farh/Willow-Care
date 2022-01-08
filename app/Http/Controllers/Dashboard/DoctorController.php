<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\ProfessionalTitle;
use App\Models\Specialty;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Validator;

class DoctorController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=Doctor::where('is_approved',1)->get();
       return  view('dashboard.doctor.index',compact('doctors'));
    }

    public function disApproved(){

        $doctors=Doctor::where('is_approved',0)->get();

        return  view('dashboard.doctor.dis-approved',compact('doctors'));
    }
    public function changeStatus(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        $doctor->is_approved = $request->active;
        $doctor->save();
        return response()->json(['success'=>'Doctor Activation  change successfully.']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        $category=Category::where('name_en','Doctor')->first();
        $titles=ProfessionalTitle::all();
        $specialities=$category->specialties;
        return  view('dashboard.doctor.create',compact('countries','specialities','titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->except(['country','title','password','speciality[]','addMoreInputFields[]']);
        $input['country_id']=$request->country;
        $input['professional_title_id']=$request->title;
        $input['password']=$request->password;
        $input['phone_verification']=1;
        $input['is_approved']=1;
        $input['activation']=1;
        if($request->hasFile('image')){
            $img=$this->uploadImages($request->image, "uploads/doctor");
            $input['image']=$img;
        }
        $doctor= Doctor::create($input);
        $doctor->specialties()->attach($request->speciality);
        if($request->hasfile('addMoreInputFields'))
        {

            foreach($request->file('addMoreInputFields') as $image)
            {
                $img = $this->uploadImages($image, "uploads/doctor/licenses");
                $doctor->licenses()->create(["image" => $img]);
            }
        }

        return redirect()->route('doctor.index')->withToastSuccess('Doctor Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return  view('dashboard.doctor.show',compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * check for email address
     *
     * @param $request
     * @return json
     */
    public function checkEmail(Request $request)
    {
        $input = $request->only(['email']);

        $request_data = [
            'email' => 'required|email|unique:doctors,email',
        ];

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'The email is available'
            ]);
        }
    }


    public function checkPhone(Request $request)
    {
        $input = $request->only(['phone']);

        $request_data = [
            'phone' => 'required|numeric|unique:doctors,phone',
        ];

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'The number is available'
            ]);
        }
    }
}
