<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignEmail extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        //
    }

    /**
     * EMAIL
     */

     public function emails()
     {
         return $this->hasOne(EmailContact::class, 'id', 'email_id')->whereNotNull('email');
     }

    //END
}
