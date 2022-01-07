<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Specialty;
use App\Traits\HelperTrait;
use Livewire\Component;
use Livewire\WithFileUploads;

class DoctorCreate extends Component
{
    use HelperTrait,WithFileUploads;
    public $country;
    public $lang;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;
    public $speciality=[];
    public $files=[];

    public $totalSteps=4;
    public $currentStep=1;

    public function mount(){
        $this->currentStep=1;

    }

    public function render()
    {
        $countries=Country::all();
        $specialities=Specialty::all();
        return view('livewire.doctor-create',['countries'=>$countries,'specialities'=>$specialities])
            ->extends('layouts.dashboard')
            ->section('content');
    }
    public function increaseStep(){

        $this->currentStep++;
        if($this->currentStep > $this->totalSteps){
            $this->currentStep=$this->totalSteps;
        }
    }

    public function decreaseStep(){
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep=1;
        }
    }

}
