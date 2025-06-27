<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    // Tipe data primary key kamu adalah string
    // protected $keyType = 'string';

    // Karena bukan auto-increment
    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'name', 'email', 'password', 'role_id'
    ];

    protected $hidden = [
        'password', 
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
