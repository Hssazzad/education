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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Product name
            $table->string('sku')->unique()->nullable(); // Product code
            $table->text('description')->nullable(); // Description
            $table->decimal('price', 10, 2); // Price with 2 decimals
            $table->integer('stock')->default(0); // Stock quantity
            $table->string('image')->nullable(); // Image path
            $table->boolean('status')->default(true); // Active/Inactive
            $table->timestamps(); // created_at & updated_at
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
