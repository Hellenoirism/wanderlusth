<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
