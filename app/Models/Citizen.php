<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Citizen extends Authenticatable
{
    protected $fillable = ['national_id', 'name', 'phone', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
