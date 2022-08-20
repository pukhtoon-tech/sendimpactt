<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class EmailGroup extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function email_groups()
    {
      return $this->hasMany(EmailListGroup::class, 'email_group_id', 'id')->where('owner_id', Auth::user()->id);
    }

    //END
}
