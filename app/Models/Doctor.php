<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\License;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'phone_verification',
        'is_approved',
        'f_code',
        'g_code',
        'a_code',
        'professional_title_id',
        'graduation_year',
        'gender',
        'about',
        'lang',
        'activation',
        'country_id',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function profTitle(): BelongsTo
    {
        return $this->belongsTo(ProfessionalTitle::class,'professional_title_id');
    }
    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'doctor_specialty');
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class);
    }

    public function clinics(): HasMany
    {
        return $this->hasMany(Clinic::class);
    }

    public function deviceTokens(): HasMany
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function insuranceCompanies(): BelongsToMany
    {
        return $this->belongsToMany(InsuranceCompany::class, 'doctor_insurance_company');
    }

    public function homeConcultations(): HasMany
    {
        return $this->hasMany(HomeConcultation::class);
    }

    public function onlineConcultations(): HasMany
    {
        return $this->hasMany(OnlineConcultation::class);
    }



}
