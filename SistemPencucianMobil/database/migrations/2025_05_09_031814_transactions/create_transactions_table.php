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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id(); // Ini akan jadi transaction_id
        $table->string('invoice_code')->unique();
        $table->string('customer_name');
        $table->unsignedBigInteger('outlet_id');
        $table->unsignedBigInteger('staff_id');
        $table->timestamp('transaction_date');
        $table->decimal('total_price', 12, 2); // Menggunakan decimal sesuai dengan skema
        $table->string('status');
        $table->timestamps();

        $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade');
        $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
