<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignLog extends Model
{
    use HasFactory;

    /*relation with campaign*/
    public function campaignEmails()
    {
        return $this->hasOne(CampaignEmail::class, 'campaign_id', 'id');
    }

    //END
}
