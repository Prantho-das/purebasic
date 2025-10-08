<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'full_name',
        'email',
        'amount',
        'status',
        'sender_number',
        'transaction_id',
        'payment_method',
        'invoice_id',
    ];
}
