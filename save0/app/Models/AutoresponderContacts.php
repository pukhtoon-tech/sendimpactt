<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoresponderContacts extends Model
{
    use HasFactory;

    public function autoresponder_template()
    {
        return $this->hasOne(AutoresponderTemplate::class, 'id', 'autoresponder_id');
    }
}
