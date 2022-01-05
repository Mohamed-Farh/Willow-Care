<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Lang;
class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
    'id' => 'string',
    ];
    protected $appends =[
        'category'
    ];


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }
    public function getCategoryAttribute()
    {
        return Lang::locale() == 'ar' ? $this->name_ar : (Lang::locale() == 'en' ? $this->name_en : $this->name_ro);
    }

    public function terms(): HasMany
    {
        return $this->hasMany(Term::class);
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'category_specialties');
    }

}