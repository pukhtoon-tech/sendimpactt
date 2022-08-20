<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;

class SmsLog extends Model
{
    use HasFactory;

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }

    //END
}
