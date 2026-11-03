<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Concerns\HasContentWorkflow;
use App\Models\Concerns\Verifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectoryEntry extends Model
{
    use Verifiable, HasContentWorkflow;

    protected $fillable = [
        'directory_category_id',
        'district_id',
        'upazila_id',
        'name',
        'slug',
        'alternative_name',
        'contact_person',
        'designation',
        'address',
        'phone',
        'emergency_phone',
        'email',
        'website',
        'opening_hours',
        'services',
        'latitude',
        'longitude',
        'featured_image',
        'short_description',
        'description',
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
            'publication_status' => PublicationStatus::class,
            'verification_status' => VerificationStatus::class,
            'verified_at' => 'datetime',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'views' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            DirectoryCategory::class,
            'directory_category_id'
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
