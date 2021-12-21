<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InsuranceCompany extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'doctor_insurance_company');
    }


}
