    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('clearances', function (Blueprint $table) {
                $table->id();
                $table->foreignId('clearance_type_id')->nullable()->constrained('clearance_types')->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->json('offices')->nullable(); // offices: dean, business_office, etc.
                $table->boolean('is_published')->default(false);
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('clearances');
        }
    };
