<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendFeature extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        //return $query->where('owner_id', Auth::user()->id);
    }

    //END
}
