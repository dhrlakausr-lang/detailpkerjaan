<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $table = 'jobs';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'company',
        'location',
        'salary',
        'description',
    ];
}
