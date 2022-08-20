<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSentRecord extends Model
{
    use HasFactory;

    public function scopeUser($query)
    {
        return $query->where('owner_id', Auth::user()->id);
    }

    //END
}
