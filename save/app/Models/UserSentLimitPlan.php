<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class UserSentLimitPlan extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('owner_id', Auth::user()->id)->where('status', 1);
    }

    //END
}
