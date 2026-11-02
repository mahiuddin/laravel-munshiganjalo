<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricalPlaceImage extends Model
{
    protected $fillable = [
        'historical_place_id',
        'image',
        'caption',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function historicalPlace(): BelongsTo
    {
        return $this->belongsTo(HistoricalPlace::class);
    }
}
