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
        Schema::create('medicines_store', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('producing_company');
            $table->date('end_date');
            $table->string('medicine_image')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price_sale', 5, 2);
            $table->decimal('basic_price', 5, 2);
            $table->decimal('profit', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines_store');
    }
};
