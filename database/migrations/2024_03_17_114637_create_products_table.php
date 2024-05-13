<?php

use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->decimal('unit_purchase_price', 8, 2)->nullable();
            $table->decimal('unit_selling_price', 8, 2)->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->integer('status')->default(0);
            $table->integer('qty')->default(0);
            $table->date('expiry_date')->nullable();
            $table->foreignIdFor(ProductCategory::class)->constrained();
            $table->foreignIdFor(ProductType::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
