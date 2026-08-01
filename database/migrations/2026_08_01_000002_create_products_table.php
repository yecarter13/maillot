<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('championship_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('club')->nullable();
            $table->string('season')->nullable();
            $table->string('sizes')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 0)->default(0);
            $table->decimal('old_price', 12, 0)->nullable();
            $table->string('image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->boolean('is_new')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
