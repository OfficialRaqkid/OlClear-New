<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clearance_requests', function (Blueprint $table) {
            // ✅ Add unique constraint for combination of student and clearance
            $table->unique(['student_id', 'clearance_id'], 'unique_student_clearance');
        });
    }

    public function down(): void
    {
        Schema::table('clearance_requests', function (Blueprint $table) {
            // ✅ Drop the unique constraint if rolled back
            $table->dropUnique('unique_student_clearance');
        });
    }
};
