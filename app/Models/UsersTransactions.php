<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersTransactions extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'yookassa_transaction_id', 'status', 'amount', 'description', 'ip'];
}
