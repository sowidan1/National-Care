<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('product_id')->constrained('products')->onDelete('cascade');
            $table->enum('action', ['created', 'updated', 'deleted']);
            $table->foreignId('changed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->json('changes')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_logs');
    }
};
