<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autoresponder extends Model
{
    use HasFactory;

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }

    public function autoresponder_contacts()
    {
        return $this->hasMany(AutoresponderContacts::class, 'autoresponder_id', 'id');
    }

    public function autoresponder_templates()
    {
        return $this->hasMany(AutoresponderTemplate::class, 'autoresponder_id', 'id');
    }
}
