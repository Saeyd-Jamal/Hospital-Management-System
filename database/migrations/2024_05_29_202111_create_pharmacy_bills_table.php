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
        Schema::create('pharmacy_bills', function (Blueprint $table) {
            $table->id();
            $table->date('buy_date'); // تاريخ الشراء
            $table->string('payment_method')->default('person'); // طريقة الدفع
            $table->decimal('total_price', 8, 2); // سعر إجمالي بدقة عشرية
            $table->decimal('final_profit', 8, 2); // الربح النهائي بدقة عشرية
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_bills');
    }
};
