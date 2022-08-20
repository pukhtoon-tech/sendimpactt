<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Demo extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        //
    }

    //END
}
