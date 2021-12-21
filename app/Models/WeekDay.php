<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeekDay extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;


    public function workingTimes(): HasMany
    {
        return $this->hasMany(WorkingTime::class);
    }

    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }

}
