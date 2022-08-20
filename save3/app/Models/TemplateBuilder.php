<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateBuilder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopePublished($query)
    {
        return $query->where('publish', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('default', true);
    }

    //END
}
