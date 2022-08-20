<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patch extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // id is guarded by default
}
