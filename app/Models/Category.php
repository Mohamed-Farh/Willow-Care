<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
    'id' => 'string',
    ];


    public function active()
    {
        return $this->status ? 'Active' : 'Not Active';
    }


}
