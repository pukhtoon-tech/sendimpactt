<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceSetting extends Model
{
    use HasFactory;

    public function marketplace_csv()
    {
        return $this->hasOne('App\Models\MarketplaceCSV', 'id', 'csv_id');
    }
}
