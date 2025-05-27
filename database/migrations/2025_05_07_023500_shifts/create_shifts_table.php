<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id('shift_id');
            $table->string('shift_name');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('is_active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('outlet_id')->references('outlet_id')->on('outlets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
