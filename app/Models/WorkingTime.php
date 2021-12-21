<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkingTime extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function type()
    {
        return $this->status ? 'For One Day' : 'For All Days';
    }

    public function WeekDay(): BelongsTo
    {
        return $this->belongsTo(DaysOfWeek::class);
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

}
