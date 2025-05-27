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
         Schema::create('expenses', function (Blueprint $table) {
            $table->id('expense_id');
            $table->string('expense_code')->nullable();
            $table->unsignedBigInteger('outlet_id')->nullable();
            $table->date('expense_date')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->timestamps();


            $table->foreign('outlet_id')->references('id')->on('outlets')->nullOnDelete();
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
