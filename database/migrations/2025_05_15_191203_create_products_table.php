<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->ulid('id')->primary();

            $table->foreignUlid('category_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('stock')->default(0);
            $table->string('image_url')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
