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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Student::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(App\Models\Semester::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(App\Models\HouseMaster::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignIdFor(App\Models\Classes::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->decimal('remaining_balance', 10, 2);
            $table->dateTime('payment_date')->default(now());
            $table->enum(
                'payment_method',
                ['cash', 'mobile_money', 'bank_transfer', 'cheque']
            )
                ->default('cash');
            $table->string('reference_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
