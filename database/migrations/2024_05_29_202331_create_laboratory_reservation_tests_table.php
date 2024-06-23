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
        Schema::create('laboratory_reservation_tests', function (Blueprint $table) {
            $table->foreignId('laboratory_reservation_id')->constrained('laboratory_patient_reservations')->cascadeOnDelete();
            $table->foreignId('test_id')->constrained('laboratory_tests')->cascadeOnDelete();
            $table->decimal('test_price', 8, 2);
            $table->text('noots');
            $table->string('file');
            $table->timestamps();

            $table->primary(['laboratory_reservation_id','test_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_reservation_tests');
    }
};
