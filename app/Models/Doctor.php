<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

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
        'graduate_year',
        'gender',
        'about',
        'lang',
        'activation',
        'country_id',
    ];



    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'doctor_specialty');
    }

    public function lisences(): HasMany
    {
        return $this->hasMany(Lisence::class);
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
}
