<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class EmailContact extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];


    /*Check the email is active*/
    public function scopeActive($query)
    {
        return $query->where('trashed', 0)->where('blocked', 0);
    }


    /*Check the email is active*/
    public function scopeFavourite($query)
    {
        return $query->where('favourites', 1)->where('blocked', 0)->where('owner_id', Auth::id());
    }

    public function scopeEmailOwner($query) {
        return $query->where('owner_id', Auth::id());
    }

    /*Check the email is active*/
    public function scopeBlocked($query)
    {
        return $query->where('blocked', 1);
    }

    /*Check the email is active*/
    public function scopeTrashedBin($query)
    {
        return $query->onlyTrashed()->where('trashed', 1);
    }

}
