<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelamarPasswordResetToken extends Model
{
    protected $table = 'pelamar_password_reset_tokens';

    protected $fillable = [
        'email',
        'token_hash',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
