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
        Schema::table('pharmacy_bills', function (Blueprint $table) {
            $table->foreignId('reservation_id')->nullable()->constrained('patient_reservations')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pharmacy_bills', function (Blueprint $table) {
            $table->dropForeign('pharmacy_bills_reservation_id_foreign');
            $table->dropColumn('reservation_id');
        });
    }
};
