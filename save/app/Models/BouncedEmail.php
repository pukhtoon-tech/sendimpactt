<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BouncedEmail extends Model
{
    use HasFactory;

    public function scopeBounced($query)
    {
        return $query->where('bounce', 0);
    }

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'camapaign_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    //END
}
