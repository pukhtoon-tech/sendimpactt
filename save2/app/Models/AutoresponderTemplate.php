<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoresponderTemplate extends Model
{
    use HasFactory;

    // relation with Template Builder
    public function template_builder()
    {
        return $this->hasOne(TemplateBuilder::class, 'id', 'template_id');
    }
}
