<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnlineConcultationWorkingTime extends Model
{
    use HasFactory;



    protected $table = 'online_concultation_working_times';
    protected $fillable = [
        'day',
        'from',
        'to',
        'onine_concultation_id',
    ];
    public $timestamps = true;



    public function onlineConcultation(): BelongsTo
    {
        return $this->belongsTo(OnlineConcultation::class);
    }


}
