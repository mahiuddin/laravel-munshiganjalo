<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historical_places', function (Blueprint $table) {
            $table->id();

            $table->foreignId('historical_place_category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('district_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('upazila_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('alternative_name')->nullable();

            $table->string('established_period')->nullable();
            $table->string('founder')->nullable();

            $table->string('address')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('featured_image')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('history')->nullable();
            $table->longText('historical_significance')->nullable();

            $table->text('source')->nullable();

            // Publication workflow
            $table->string('publication_status')->default('draft');
            $table->string('verification_status')->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable();
            $table->text('verification_notes')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();

            $table->index([
                'publication_status',
                'verification_status',
            ]);

            $table->index([
                'district_id',
                'upazila_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historical_places');
    }
};
