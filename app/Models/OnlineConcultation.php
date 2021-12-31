<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnlineConcultation extends Model
{
    use HasFactory;



    protected $table = 'online_concultations';
    protected $fillable = [
        'doctor_id',
        'price',
        'renewal_price',
    ];
    public $timestamps = true;



    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
