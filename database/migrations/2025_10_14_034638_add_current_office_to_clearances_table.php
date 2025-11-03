<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('clearances', function (Blueprint $table) {
            $table->string('current_office')->nullable()->after('offices');
        });
    }

    public function down(): void
    {
        Schema::table('clearances', function (Blueprint $table) {
            $table->dropColumn('current_office');
        });
    }
};
