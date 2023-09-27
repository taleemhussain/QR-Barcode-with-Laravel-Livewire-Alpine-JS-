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
            $table->id();
            $table->string('title')->nullable()->default(null);
            $table->float('price',8,2)->nullable()->default(null);
            $table->integer('quantity')->nullable()->default(null);
            $table->integer('category_id')->nullable()->default(null);
            $table->integer('brand_id')->nullable()->default(null);
            $table->integer('warehouse_id')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);;
            $table->boolean('status')->default(0);
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
