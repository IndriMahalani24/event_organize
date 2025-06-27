<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $table = 'panitia';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'divisi',
        'users_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
