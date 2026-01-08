<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('clearances', function (Blueprint $table) {

            /**
             * REQUIRED: Fix foreach() error
             * offices must be JSON for array casting
             */
            $table->json('offices')->change();

            /**
             * REQUIRED by ClearanceController
             */
            if (!Schema::hasColumn('clearances', 'school_year')) {
                $table->string('school_year');
            }

            /**
             * Nullable for Marching clearance
             */
            if (!Schema::hasColumn('clearances', 'semester')) {
                $table->string('semester')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('clearances', function (Blueprint $table) {
            $table->text('offices')->change();
            $table->dropColumn(['school_year', 'semester']);
        });
    }
};
