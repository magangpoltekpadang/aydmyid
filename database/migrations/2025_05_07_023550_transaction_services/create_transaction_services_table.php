<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_services', function (Blueprint $table) {
            $table->id('transaction_service_id ');
            $table->int('quantity');
            $table->decimal('unit_price', 10,2);
            $table->decimal('discount', 10,2);
            $table->decimal('total_price', 10,2);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['pending','in_progress', 'completed', 'cancelled']);
            $table->text('notes');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
            $table->foreign('service_id ')->references('service_id')->on('services')->onDelete('cascade');
            $table->foreign('worker_id')->references('worker_id')->on('staff')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_services');
    }
};
