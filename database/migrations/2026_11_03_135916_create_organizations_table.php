<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            // Category and location
            $table->foreignId('organization_category_id')
                ->constrained('organization_categories')
                ->restrictOnDelete();

            $table->foreignId('district_id')
                ->constrained('districts')
                ->restrictOnDelete();

            $table->foreignId('upazila_id')
                ->nullable()
                ->constrained('upazilas')
                ->nullOnDelete();

            // Basic information
            $table->string('name', 200);
            $table->string('slug', 220)->unique('org_slug_uq');
            $table->string('alternative_name', 200)->nullable();

            $table->string('registration_number', 100)->nullable();
            $table->string('registration_authority', 150)->nullable();

            $table->unsignedSmallInteger('established_year')->nullable();

            // Contact persons
            $table->string('president_name', 150)->nullable();
            $table->string('secretary_name', 150)->nullable();
            $table->string('contact_person', 150)->nullable();

            // Contact information
            $table->text('address')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('website', 255)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Content
            $table->string('featured_image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('activities')->nullable();
            $table->longText('services')->nullable();
            $table->text('source')->nullable();

            // Publication workflow
            $table->string('publication_status', 30)->default('draft');
            $table->string('verification_status', 30)->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable();
            $table->text('verification_notes')->nullable();

            // SEO and statistics
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();

            $table->index('organization_category_id', 'org_category_idx');
            $table->index(['district_id', 'upazila_id'], 'org_location_idx');
            $table->index(
                ['publication_status', 'verification_status'],
                'org_status_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};