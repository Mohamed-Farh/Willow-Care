<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Lang;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends =[
        'country'
    ];

    public $timestamps = false;

    public function getCountryAttribute()
    {
        return Lang::locale() == 'ar' ? $this->name_ar : (Lang::locale() == 'en' ? $this->name_en : $this->name_ro);
    }

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

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }



}
