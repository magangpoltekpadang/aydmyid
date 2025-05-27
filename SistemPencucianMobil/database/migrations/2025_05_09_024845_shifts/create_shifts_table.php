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
        Schema::create('shifts', function (Blueprint $table) {
            $table->bigIncrements('shift_id');
            $table->unsignedBigInteger('outlet_id');
            $table->string('shift_name');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();

            //$table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('outlet_id')->references('outlet_id')->on('outlets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
