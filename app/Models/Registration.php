<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registration';

    protected $fillable = [
        'id',
        'date',
        'checkin_time',
        'checkout_time',
        'qrcode',
        'payment_status',
        'certificate',
        'users_iduser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_iduser', 'id');
    }

    public function paymentVerification()
    {
        return $this->hasOne(PaymentVerification::class, 'registration_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id'); // jika relasi ini ditambahkan di tabel kamu
    }
}
