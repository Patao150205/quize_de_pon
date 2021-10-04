<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'token',
        'expiration_datetime',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
