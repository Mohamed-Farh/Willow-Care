<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Lang;

class InsuranceCompany extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends =[
        'company'
    ];


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'doctor_insurance_company');
    }
    public function getCompanyAttribute()
    {
        return Lang::locale() == 'ar' ? $this->name_ar : (Lang::locale() == 'en' ? $this->name_en : $this->name_ro);
    }


}
