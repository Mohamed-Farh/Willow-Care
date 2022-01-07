<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Lang;

class Term extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
    'id' => 'string',
    ];
    protected $appends =[
        'term'
    ];

    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getTermAttribute()
    {
        return Lang::locale() == 'ar' ? $this->text_ar : (Lang::locale() == 'en' ? $this->text_en : $this->text_ro);
    }
}
