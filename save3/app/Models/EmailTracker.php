<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTracker extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function campaign_name()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }

    // END
}
