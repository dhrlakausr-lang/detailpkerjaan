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
        'status',
        'interview_schedule',
        'interview_contact_name',
        'interview_contact_info',
        'interview_note',
        'applicant_response',
        'reschedule_requested_at',
        'reschedule_schedule',
        'reschedule_reason',
        'reschedule_status',
        'reschedule_admin_note',
    ];

    protected $casts = [
        'interview_schedule' => 'datetime',
        'reschedule_requested_at' => 'datetime',
        'reschedule_schedule' => 'datetime',
    ];
}
