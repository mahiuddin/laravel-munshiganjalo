<?php

namespace App\Services;

use App\Enums\VerificationStatus;
use App\Models\VerificationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class VerificationService
{
    /**
     * Verify content.
     */
    public function verify(
        Model $model,
        ?string $notes = null,
        ?int $userId = null
    ): Model {
        return $this->review(
            $model,
            VerificationStatus::VERIFIED,
            $notes,
            $userId
        );
    }

    /**
     * Reject content.
     */
    public function reject(
        Model $model,
        string $notes,
        ?int $userId = null
    ): Model {
        if (trim($notes) === '') {
            throw new InvalidArgumentException(
                'A rejection reason is required.'
            );
        }

        return $this->review(
            $model,
            VerificationStatus::REJECTED,
            $notes,
            $userId
        );
    }

    /**
     * Update verification status and create history log.
     */
    private function review(
        Model $model,
        VerificationStatus $newStatus,
        ?string $notes,
        ?int $userId
    ): Model {
        return DB::transaction(function () use (
            $model,
            $newStatus,
            $notes,
            $userId
        ) {
            $model = $model->newQuery()
                ->lockForUpdate()
                ->findOrFail($model->getKey());

            $oldStatus = $model->getAttribute('verification_status');

            if ($oldStatus === $newStatus->value) {
                throw new InvalidArgumentException(
                    'Content already has this verification status.'
                );
            }

            $reviewerId = $userId ?? Auth::id();

            $model->setAttribute(
                'verification_status',
                $newStatus->value
            );

            $model->setAttribute('verified_by', $reviewerId);
            $model->setAttribute(
                'verified_at',
                $newStatus === VerificationStatus::VERIFIED ? now() : null
            );
            $model->setAttribute('verification_notes', $notes);

            $model->save();

            VerificationLog::query()->forceCreate([
                'verifiable_type' => $model->getMorphClass(),
                'verifiable_id' => $model->getKey(),
                'user_id' => $reviewerId,
                'old_status' => $oldStatus,
                'new_status' => $newStatus->value,
                'notes' => $notes,
            ]);

            return $model->refresh();
        });
    }
}