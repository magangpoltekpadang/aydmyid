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
            Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('notification_type_id')->nullable();
            $table->text('message')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->integer('retry_count')->nullable();
            $table->timestamp('created_at')->useCurrent();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
