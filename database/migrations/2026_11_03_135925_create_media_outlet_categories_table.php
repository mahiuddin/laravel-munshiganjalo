<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_outlet_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);
            $table->string('slug', 180)->unique('media_cat_slug_uq');
            $table->text('description')->nullable();

            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('status', 'media_cat_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_outlet_categories');
    }
};