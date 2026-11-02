<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'status'];

    protected function casts(): array
    {
        return ['status' => 'boolean'];
    }

    public function institutions(): HasMany
    {
        return $this->hasMany(EducationInstitution::class);
    }
}