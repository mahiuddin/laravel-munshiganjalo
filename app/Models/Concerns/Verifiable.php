<?php

namespace App\Models\Concerns;

use App\Models\VerificationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin Model
 * @method MorphMany morphMany(string $related, string $name, ?string $type = null, ?string $id = null, ?string $localKey = null)
 */
trait Verifiable
{
    public function verificationLogs(): MorphMany
    {
        return $this->morphMany(VerificationLog::class, 'verifiable')
            ->latest();
    }
}