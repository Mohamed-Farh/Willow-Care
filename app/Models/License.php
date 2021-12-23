<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Doctor;

class License extends Model
{
    use HasFactory;
    protected $table = 'licenses';
    public $timestamps = true;

    protected $fillable = array('image');


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
