<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
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
