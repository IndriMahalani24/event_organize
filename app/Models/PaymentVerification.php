<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentVerification extends Model
{
    protected $table = 'payment_verification';

    protected $fillable = [
        'id',
        'registration_id',
        'date',
        'status',
        'payment_proof'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'registration_id', 'id');
    }
}
