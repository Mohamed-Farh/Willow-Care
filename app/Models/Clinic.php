<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory;

    protected $guarded = [];



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

    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }



}
