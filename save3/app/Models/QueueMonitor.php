<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueMonitor extends Model
{
    use HasFactory;

    protected $table = 'queue_monitor';

    const CREATED_AT = 'started_at';

    public function scopeActive($query)
    {
        //
    }

    //END
}
