<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->id('outlet_id');
            $table->sting('outlet_name');
            $table->string('address');
            $table->string('phone_number');
            $table->decimal('latitude', 10,8);
            $table->decimal('longitude', 10,8);
            $table->boolean('is_active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }
  
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
