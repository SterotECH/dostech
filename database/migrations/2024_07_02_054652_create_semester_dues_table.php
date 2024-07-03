<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('semester_dues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Semester::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->decimal('total_dues', 10, 2)->default(0.00);
            $table->integer('pta_percentage')->default(40);
            $table->integer('teacher_motivation_percentage')->default(60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_dues');
    }
};
