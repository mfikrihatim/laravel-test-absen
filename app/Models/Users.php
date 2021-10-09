<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = "id_users";
    protected $table = "users";
    protected $fillable = ['id_users', 'username', 'email', 'password'];
    protected $hidden = ['password'];

    /* Relation Has Many Level */
    public function absen()
    {
        return $this->hasMany(Absen::class);
    }
}