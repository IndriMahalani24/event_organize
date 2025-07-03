<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'location',
        'event_date',
        'event_time',
        'registration_fee',
        'max_participants',
        'speaker',
        'status',
        'poster',
        'users_iduser'
    ];

    protected $casts = [
        'event_date' => 'date',
        'end_time' => 'datetime', // Menggunakan datetime agar bisa format time saja
    ];

    // Relasi: Event dimiliki oleh satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'event_category');
    }

    // Relasi: Satu event memiliki banyak pendaftaran
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    /**
     * Get the number of registrations for this event.
     */
    public function getRegistrationCountAttribute()
    {
        return $this->registrations()->count();
    }

    /**
     * Check if event has reached maximum participants.
     */
    public function getIsFullAttribute()
    {
        return $this->registration_count >= $this->max_participants;
    }

    /**
     * Check if an event is upcoming.
     */
    public function getIsUpcomingAttribute()
    {
        return $this->event_date->isFuture();
    }

    /**
     * Get formatted registration fee.
     */
    public function getFormattedFeeAttribute()
    {
        return 'Rp ' . number_format($this->registration_fee, 0, ',', '.');
    }
}
