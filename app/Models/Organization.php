<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Organization extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
         'national_id',
         'phone',
         'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
