<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'description',
        'location',
        'max_participants',
        'status',
        'speaker',
        'event_time',
        'event_date',
        'users_iduser'
    ];

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'users_iduser', 'id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'event_id', 'id');
    }
}
