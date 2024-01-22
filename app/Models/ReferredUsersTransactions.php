<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferredUsersTransactions extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'telegram_id', 'uuid', 'yookassa_transaction_id', 'status', 'referral_id', 'amount', 'description', 'ip'];
}
