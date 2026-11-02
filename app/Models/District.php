<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class District extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function upazilas(): HasMany
    {
        return $this->hasMany(Upazila::class);
    }
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
    public function information(): HasOne
    {
        return $this->hasOne(DistrictInformation::class);
    }
    public function educationInstitutions(): HasMany
    {
        return $this->hasMany(EducationInstitution::class);
    }
}