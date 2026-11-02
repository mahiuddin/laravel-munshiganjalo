<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Concerns\HasContentWorkflow;
use App\Models\Concerns\Verifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DistrictInformation extends Model
{
    use Verifiable, HasContentWorkflow;

    protected $table = 'district_information';

    protected $fillable = [
        'district_id',
        'tagline',
        'area',
        'population',
        'population_year',
        'density',
        'established_year',
        'postal_code',
        'official_website',
        'featured_image',
        'overview',
        'history',
        'geography',
        'economy',
        'culture',
        'communication',
        'rivers',
        'education',
        'administration',
        'tourism',
        'sources',
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
            'views' => 'integer',
        ];
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
