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
        
        Schema::create('education_institutions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('education_category_id')
                ->constrained('education_categories')
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

            $table->string('eiin')->nullable()->index();
            $table->string('institution_type')->nullable();
            $table->string('management_type')->nullable();

            $table->unsignedSmallInteger('established_year')->nullable();
            $table->string('head_name')->nullable();

            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('featured_image')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('history')->nullable();
            $table->longText('facilities')->nullable();
            $table->longText('academic_information')->nullable();
            $table->text('source')->nullable();

            $table->string('publication_status')->default('draft');
            $table->string('verification_status')->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable();
            $table->text('verification_notes')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();

            $table->index(['publication_status', 'verification_status'],'edu_inst_status_idx');
            $table->index(['district_id', 'upazila_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_institutions');
    }
};
