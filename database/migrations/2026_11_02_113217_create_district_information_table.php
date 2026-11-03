<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('district_information', function (Blueprint $table) {
            $table->id();

            $table->foreignId('district_id')
                ->unique()
                ->constrained()
                ->restrictOnDelete()
                ->name('district_info_district_fk');

            $table->string('tagline')->nullable();
            $table->string('area')->nullable();
            $table->string('population')->nullable();
            $table->string('population_year')->nullable();
            $table->string('density')->nullable();
            $table->string('established_year')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('official_website')->nullable();

            $table->string('featured_image')->nullable();

            $table->longText('overview')->nullable();
            $table->longText('history')->nullable();
            $table->longText('geography')->nullable();
            $table->longText('economy')->nullable();
            $table->longText('culture')->nullable();
            $table->longText('communication')->nullable();
            $table->longText('rivers')->nullable();
            $table->longText('education')->nullable();
            $table->longText('administration')->nullable();
            $table->longText('tourism')->nullable();
            $table->longText('sources')->nullable();

            $table->string('publication_status')->default('draft');
            $table->string('verification_status')->default('pending');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->name('district_info_verified_by_fk');

            $table->timestamp('verified_at')->nullable();
            $table->text('verification_notes')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();

            $table->index(['publication_status', 'verification_status'], 'district_info_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('district_information');
    }
};
