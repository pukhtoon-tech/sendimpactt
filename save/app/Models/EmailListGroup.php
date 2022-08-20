<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailListGroup extends Model
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
         return $this->HasOne(EmailContact::class, 'id', 'email_id');
     }

    //END
}
