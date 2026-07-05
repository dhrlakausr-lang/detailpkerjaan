<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'pelamar';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'job_id',
    ];
}
