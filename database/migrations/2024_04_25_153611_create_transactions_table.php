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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['purchase', 'sale']);
            $table->unsignedBigInteger('counterparty_id'); // supplier_id or customer_id
            $table->string('counterparty_type'); // 'supplier' or 'customer'
            $table->string('payment_method');
            $table->string('payment_number');
            $table->decimal('amount_total', 10, 2);
	        $table->decimal('amount_paid', 10, 2);
            $table->timestamps();
            // Indexes
            $table->index(['counterparty_id', 'counterparty_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
