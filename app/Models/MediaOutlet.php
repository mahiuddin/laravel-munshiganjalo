<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Concerns\HasContentWorkflow;
use App\Models\Concerns\Verifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaOutlet extends Model
{
    use Verifiable, HasContentWorkflow;

    protected $fillable = [
        'media_outlet_category_id',
        'district_id',
        'upazila_id',
        'name',
        'slug',
        'alternative_name',
        'language',
        'publication_frequency',
        'established_year',
        'owner_name',
        'editor_name',
        'contact_person',
        'address',
        'phone',
        'email',
        'website',
        'facebook_url',
        'youtube_url',
        'latitude',
        'longitude',
        'featured_image',
        'short_description',
        'description',
        'coverage_area',
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
            'established_year' => 'integer',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'views' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            MediaOutletCategory::class,
            'media_outlet_category_id'
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
