<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('stock')->default(0); // Corregido: eliminé el (10)
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla para tallas
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: 'S', 'M', 'L', 'XL'
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Tabla para colores
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: 'Rojo', 'Azul'
            $table->string('hex_code')->nullable(); // Código hexadecimal del color
            $table->timestamps();
        });

        // Tabla intermedia producto-talla (para manejar stock por talla)
        Schema::create('product_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        // Tabla intermedia producto-color
        Schema::create('product_color', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('product_color');
        Schema::dropIfExists('product_size');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('products');
    }
};