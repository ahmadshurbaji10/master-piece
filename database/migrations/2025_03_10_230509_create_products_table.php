<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade'); // Store relation
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Product description
            $table->decimal('price', 10, 2); // Original price
            $table->decimal('discount_price', 10, 2)->nullable(); // Discounted price
            $table->integer('stock'); // Stock quantity
            $table->date('expiry_date')->nullable(); // Expiry date
            $table->string('image_url')->nullable(); // Image URL
            $table->timestamps(); // Created_at & Updated_at
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
