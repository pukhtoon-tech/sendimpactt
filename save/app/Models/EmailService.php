<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class EmailService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        // return $query->where('active', 1)->where('owner_id', Auth::user()->id);
    }

    /** VERSION 3 */
    public function sender_email()
    {
        return $this->hasOne(SenderEmailId::class, 'email_service_id', 'id');
    }

    public function sender_email_without_auth()
    {
        return $this->hasOne(SenderEmailId::class, 'email_service_id', 'id');
    }
    /** VERSION 3::END */

    //END
}
