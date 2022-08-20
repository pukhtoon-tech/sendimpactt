<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class UserSentRecord extends Model
{
    use HasFactory;

    public function scopeUser($query)
    {
        return $query->where('owner_id', Auth::user()->id);
    }

    //END
}
