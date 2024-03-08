<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersImages extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'image_data'];
}
