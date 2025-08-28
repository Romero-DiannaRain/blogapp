<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    // Table name (optional if your table is 'students')
    protected $table = 'students';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'password', // optional if you store password
    ];

    // Hidden attributes when serializing
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
