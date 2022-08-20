<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;

class ScheduleEmail extends Model
{
    use HasFactory;

    /**
     * STATUS: PENDING
     */
    const PENDING = 'PENDING';

    /**
     * STATUS: SENDED
     */
    const SENT = 'SENT';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['campaign_id', 'scheduled_at', 'status'];

    /**
     * Reset the timestamps value
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['scheduled_at'];

    /**
     * campaign
     */
    function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }

}
