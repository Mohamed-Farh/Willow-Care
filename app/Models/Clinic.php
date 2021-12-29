<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory;

    protected $table = 'clinics';
    protected $fillable = [
        'name',
        'phone',
        'another_phone',
        'lat',
        'long',
        'location',
        'price',
        'renewal_price',
        'duration',
        'payment_method',
        'image',
        'doctor_id',
        'active',
        'setting',
    ];
    public $timestamps = true;


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function workingTimes(): HasMany
    {
        return $this->hasMany(WorkingTime::class);
    }

    public function dayOfWorkingTime($query, $day)
    {
        return $query->whereHas('workingTimes', function ($query, $day) {

            $query->where('day', $day);
        });
    }



}
