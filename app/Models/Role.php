<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'id';

    protected $fillable = ['id','name'];
    
    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
