<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeConcultationWorkingTime extends Model
{
    use HasFactory;

    protected $table = 'home_concultation_working_times';
    protected $fillable = [
        'day',
        'from',
        'to',
        'home_concultation_id',
    ];
    public $timestamps = true;



    public function homeConcultation(): BelongsTo
    {
        return $this->belongsTo(HomeConcultation::class);
    }



}
