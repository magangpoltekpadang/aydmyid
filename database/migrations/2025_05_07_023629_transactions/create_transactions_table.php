<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('transaction_code');
            $table->dateTime('transaction_date');
            $table->decimal('subtotal', 10,2);
            $table->decimal('discount', 10,2);
            $table->decimal('tax', 10,2);
            $table->decimal('final_price', 10,2);
            $table->boolean('gate_opened');
            $table->boolean('receipt_printed');
            $table->boolean('whatsapp_sentd');
            $table->text('notes');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('outlet_id')->references('outlet_id')->on('outlets')->onDelete('cascade');
            $table->foreign('payment_status_id')->references('payment_status_id')->on('payment_statuses')->onDelete('cascade');
            $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('cascade');
            $table->foreign('shift_id')->references('shift_id')->on('shifts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
