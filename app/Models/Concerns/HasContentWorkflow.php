<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Model
 */
trait HasContentWorkflow
{
    /**
     * Administrator who verified the content.
     */
    public function verifiedBy(): BelongsTo
    {
        /** @var Model $this */
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Scope: show only published and verified content.
     */
    public function scopePubliclyVisible(Builder $query): Builder
    {
        return $query
            ->where('publication_status', 'published')
            ->where('verification_status', 'verified');
    }

    /**
     * Check whether content is publicly visible.
     */
    public function isPubliclyVisible(): bool
    {
        return $this->getAttribute('publication_status')?->value === 'published'
            && $this->getAttribute('verification_status')?->value === 'verified';
    }
}