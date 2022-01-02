<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeConcultation extends Model
{
    use HasFactory;

    protected $table = 'home_concultations';
    protected $fillable = [
        'doctor_id',
        'price',
        'renewal_price',
        'payment_method',
    ];
    public $timestamps = true;



    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function workingTimes(): HasMany
    {
        return $this->hasMany(HomeConcultationWorkingTime::class);
    }


}
