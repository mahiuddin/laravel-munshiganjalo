<?php

namespace Database\Seeders;

use App\Models\HistoricalPlaceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HistoricalPlaceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'স্মৃতিস্তম্ভ',
                'slug' => 'monuments',
            ],
            [
                'name' => 'প্রত্নতাত্ত্বিক স্থান',
                'slug' => 'archaeological-sites',
            ],
            [
                'name' => 'দুর্গ',
                'slug' => 'forts',
            ],
            [
                'name' => 'জমিদার বাড়ি',
                'slug' => 'zamindar-houses',
            ],
            [
                'name' => 'মসজিদ',
                'slug' => 'mosques',
            ],
            [
                'name' => 'মন্দির',
                'slug' => 'temples',
            ],
            [
                'name' => 'স্মৃতিসৌধ',
                'slug' => 'memorials',
            ],
            [
                'name' => 'জাদুঘর',
                'slug' => 'museums',
            ],
            [
                'name' => 'নদী ও প্রাকৃতিক দর্শনীয় স্থান',
                'slug' => 'rivers-natural-attractions',
            ],
            [
                'name' => 'পর্যটন আকর্ষণ',
                'slug' => 'tourist-attractions',
            ],
        ];

        foreach ($categories as $category) {
            HistoricalPlaceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'status' => true,
                ]
            );
        }
    }
}
