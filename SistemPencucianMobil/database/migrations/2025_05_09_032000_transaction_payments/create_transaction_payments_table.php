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
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id('payment_id'); 

            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->string('reference_number', 100)->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('payment_statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payments');
    }
};
