<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

}
