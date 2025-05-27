<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notifications_id');
            $table->text('message');
            $table->date('sent_at');
            $table->string('retry_count');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade'); 
            $table->foreign('notification_type_id')->references('notification_type_id')->on('notification_types')->onDelete('cascade'); 
            $table->foreign('status_id')->references('status_id')->on('notification_statuses')->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
