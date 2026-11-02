<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Concerns\HasContentWorkflow;
use App\Models\Concerns\Verifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationInstitution extends Model
{
    use Verifiable, HasContentWorkflow;

    protected $fillable = [
        'education_category_id',
        'district_id',
        'upazila_id',
        'name',
        'slug',
        'alternative_name',
        'eiin',
        'institution_type',
        'management_type',
        'established_year',
        'head_name',
        'address',
        'phone',
        'email',
        'website',
        'latitude',
        'longitude',
        'featured_image',
        'short_description',
        'history',
        'facilities',
        'academic_information',
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
            'views' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EducationCategory::class, 'education_category_id');
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
        return $this->hasMany(EducationInstitutionImage::class)
            ->orderBy('sort_order');
    }
}
