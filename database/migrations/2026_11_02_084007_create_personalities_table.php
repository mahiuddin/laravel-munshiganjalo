<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personalities', function (Blueprint $table) {
            $table->id();

            // Basic information
            $table->foreignId('personality_category_id')
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
            $table->string('designation')->nullable();

            // Biography
            $table->text('short_bio')->nullable();
            $table->longText('biography')->nullable();

            // Additional information
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('photo')->nullable();

            // Sources and references
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

            // SEO and tracking
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();

            $table->index([
                'publication_status',
                'verification_status',
            ]);

            $table->index(['district_id', 'upazila_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personalities');
    }
};