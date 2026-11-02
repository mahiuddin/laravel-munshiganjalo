<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationInstitutionImage extends Model
{
    protected $fillable = [
        'education_institution_id',
        'image',
        'caption',
        'sort_order',
    ];

    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(EducationInstitution::class, 'education_institution_id');
    }
}
