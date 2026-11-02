<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Concerns\HasContentWorkflow;
use App\Models\Concerns\Verifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HistoricalPlace extends Model
{
    use Verifiable;
    use HasContentWorkflow;

    protected $fillable = [
        'historical_place_category_id',
        'district_id',
        'upazila_id',
        'name',
        'slug',
        'alternative_name',
        'established_period',
        'founder',
        'address',
        'latitude',
        'longitude',
        'featured_image',
        'short_description',
        'history',
        'historical_significance',
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
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'verified_at' => 'datetime',
            'publication_status' => PublicationStatus::class,
            'verification_status' => VerificationStatus::class,
            'views' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            HistoricalPlaceCategory::class,
            'historical_place_category_id'
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

    public function images(): HasMany
    {
        return $this->hasMany(HistoricalPlaceImage::class)
            ->orderBy('sort_order');
    }
}
