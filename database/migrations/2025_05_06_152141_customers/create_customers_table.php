<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->sting('plate_number');
            $table->sting('name');
            $table->string('phone_number');
            $table->string('vehicle_color');
            $table->string('member_number');
            $table->date('join_date');
            $table->date('member_expiry_date');
            $table->boolean('is_member');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('vehicle_type_id')->references('vehicle_type_id')->on('vehicle_types')->onDelete('cascade');  
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
