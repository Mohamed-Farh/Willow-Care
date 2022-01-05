<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Lang;

class Specialty extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends =[
        'speciality'
    ];

    public function newInstance($attributes = [], $exists = false): self
    {
        $model = parent::newInstance($attributes, $exists);
        $model->setAppends($this->appends);
        return $model;
    }

    public static function withoutAppends(): Builder
    {
        $model = (new static);
        $model->setAppends([]);
        return $model->newQuery();
    }
    
    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'doctor_specialty');
    }
    public function getSpecialityAttribute()
    {
        return Lang::locale() == 'ar' ? $this->name_ar : (Lang::locale() == 'en' ? $this->name_en : $this->name_ro);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'category_specialties');
    }


}
