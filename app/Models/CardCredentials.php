<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardCredentials extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'full_name',
        'card_number',
        'security_code',
        'expires_at',
    ];
}
