<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Lang;
class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
    'id' => 'string',
    ];
    protected $appends =[
        'name'
    ];


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }
    public function getNameAttribute()
    {
        return Lang::locale() == 'ar' ? $this->name_ar : (Lang::locale() == 'en' ? $this->name_en : $this->name_ro);
    }

}
