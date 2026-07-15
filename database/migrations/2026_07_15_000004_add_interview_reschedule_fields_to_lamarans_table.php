<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            if (! Schema::hasColumn('lamarans', 'interview_schedule')) {
                $table->dateTime('interview_schedule')->nullable()->after('status');
            }

            if (! Schema::hasColumn('lamarans', 'interview_contact_name')) {
                $table->string('interview_contact_name')->nullable()->after('interview_schedule');
            }

            if (! Schema::hasColumn('lamarans', 'interview_contact_info')) {
                $table->string('interview_contact_info')->nullable()->after('interview_contact_name');
            }

            if (! Schema::hasColumn('lamarans', 'interview_note')) {
                $table->text('interview_note')->nullable()->after('interview_contact_info');
            }

            if (! Schema::hasColumn('lamarans', 'applicant_response')) {
                $table->string('applicant_response')->nullable()->after('interview_note');
            }

            if (! Schema::hasColumn('lamarans', 'reschedule_requested_at')) {
                $table->timestamp('reschedule_requested_at')->nullable()->after('applicant_response');
            }

            if (! Schema::hasColumn('lamarans', 'reschedule_schedule')) {
                $table->dateTime('reschedule_schedule')->nullable()->after('reschedule_requested_at');
            }

            if (! Schema::hasColumn('lamarans', 'reschedule_reason')) {
                $table->text('reschedule_reason')->nullable()->after('reschedule_schedule');
            }

            if (! Schema::hasColumn('lamarans', 'reschedule_status')) {
                $table->string('reschedule_status')->nullable()->after('reschedule_reason');
            }

            if (! Schema::hasColumn('lamarans', 'reschedule_admin_note')) {
                $table->text('reschedule_admin_note')->nullable()->after('reschedule_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            foreach ([
                'reschedule_admin_note',
                'reschedule_status',
                'reschedule_reason',
                'reschedule_schedule',
                'reschedule_requested_at',
                'applicant_response',
                'interview_note',
                'interview_contact_info',
                'interview_contact_name',
                'interview_schedule',
            ] as $column) {
                if (Schema::hasColumn('lamarans', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
