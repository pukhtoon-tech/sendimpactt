<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Currency extends Model
{
    use HasFactory;

    public function scopePublished($query){
        return  $query->where('is_published', 1);
    }

    //END
}
