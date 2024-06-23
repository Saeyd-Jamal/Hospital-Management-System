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
        Schema::create('bill_medicines', function (Blueprint $table) {
            $table->foreignId('bill_id')->constrained('pharmacy_bills')->cascadeOnDelete();
            $table->foreignId('medicine_id')->constrained('medicines_store')->cascadeOnDelete();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 8, 2);
            $table->decimal('profit', 8, 2);
            $table->timestamps();

            $table->primary(['bill_id','medicine_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_medicines');
    }
};
