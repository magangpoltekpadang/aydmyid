<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('membership_transactions', function (Blueprint $table) {
            $table->id('member_transaction_id');
            $table->date('transaction_date');
            $table->date('expiry_date');
            $table->decimal('price', 10,8);
            $table->string('receipt_number');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade'); 
            $table->foreign('package_id')->references('package_id')->on('membership_packages')->onDelete('cascade');
            $table->foreign('outlet_id')->references('outlet_id')->on('outlets')->onDelete('cascade'); 
            $table->foreign('payment_method_id')->references('payment_method_id')->on('payment_methods')->onDelete('cascade');  
            $table->foreign('staff_id')->references('staff_id')->on('staffs')->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_transactions');
    }
};
