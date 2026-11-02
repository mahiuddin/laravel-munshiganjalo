<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Concerns\HasContentWorkflow;
use App\Models\Concerns\Verifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Personality extends Model
{
    use Verifiable;
    use HasContentWorkflow;

    protected $fillable = [
        'personality_category_id',
        'district_id',
        'upazila_id',
        'name',
        'slug',
        'designation',
        'short_bio',
        'biography',
        'date_of_birth',
        'date_of_death',
        'birth_place',
        'photo',
        'source',
        'publication_status',
        'verification_status',
        'verified_by',
        'verified_at',
        'verification_notes',
        'meta_title',
        'meta_description',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'date_of_death' => 'date',
            'verified_at' => 'datetime',
            'publication_status' => PublicationStatus::class,
            'verification_status' => VerificationStatus::class,
            'views' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            PersonalityCategory::class,
            'personality_category_id'
        );
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }
}