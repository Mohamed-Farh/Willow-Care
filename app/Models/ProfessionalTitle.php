<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class ProfessionalTitle extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $casts = [
    //     'id' => 'string',
    // ];
    protected $appends =[
        'title'
    ];

    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function getTitleAttribute()
    {
        return Lang::locale() == 'ar' ? $this->name_ar : (Lang::locale() == 'en' ? $this->name_en : $this->name_ro);
    }

}
