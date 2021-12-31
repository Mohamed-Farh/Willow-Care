<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
