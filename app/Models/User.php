<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    // Tipe data primary key kamu adalah string
    // protected $keyType = 'string';

    // Karena bukan auto-increment
    public $incrementing = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
        ];
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'users_iduser', 'id');
    }

}
