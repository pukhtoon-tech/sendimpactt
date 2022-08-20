<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceCSV extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relation with marketplace_setting
    public function marketplace_setting()
    {
        return $this->hasOne(MarketplaceSetting::class, 'csv_id', 'id');
    }
}
