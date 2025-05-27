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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id'); // primary key
            $table->string('plate_number')->unique();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('member_number')->nullable()->unique();
            $table->dateTime('join_date')->nullable();
            $table->dateTime('member_expiry_date')->nullable();
            $table->boolean('is_member')->default(false);
            $table->timestamps();

            // foreign key ke vehicle_types jika ada
            $table->foreign('vehicle_type_id')->references('vehicle_type_id')->on('vehicle_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
