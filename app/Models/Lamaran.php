<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'hp',
        'posisi',
        'perusahaan',
        'portfolio',
        'cover_letter',
        'cv',
        'status'
    ];
}
