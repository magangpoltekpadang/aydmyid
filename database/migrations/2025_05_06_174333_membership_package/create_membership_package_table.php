<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('package_name');
            $table->string('duration_days');
            $table->decimal('price', 10, 2);
            $table->string('max_vehicles');
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('membership_packages');
    }
};
