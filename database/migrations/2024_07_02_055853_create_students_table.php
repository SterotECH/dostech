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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\House::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(App\Models\Department::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(App\Models\Classes::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->string('registration_number', 100);
            $table->date('date_of_birth')->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('other_names', 100)->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->decimal('dues_owed', 10, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->boolean('has_completed')->default(false);
            $table->date('valid_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
