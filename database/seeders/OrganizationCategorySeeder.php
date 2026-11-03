<?php

namespace Database\Seeders;

use App\Models\OrganizationCategory;
use Illuminate\Database\Seeder;

class OrganizationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Government Organizations', 'slug' => 'government-organizations'],
            ['name' => 'Social Organizations', 'slug' => 'social-organizations'],
            ['name' => 'Cultural Organizations', 'slug' => 'cultural-organizations'],
            ['name' => 'Business Organizations', 'slug' => 'business-organizations'],
            ['name' => 'Religious Organizations', 'slug' => 'religious-organizations'],
            ['name' => 'Non-Governmental Organizations', 'slug' => 'non-governmental-organizations'],
            ['name' => 'Sports Organizations', 'slug' => 'sports-organizations'],
            ['name' => 'Professional Organizations', 'slug' => 'professional-organizations'],
            ['name' => 'Educational Organizations', 'slug' => 'educational-organizations'],
            ['name' => 'Other Organizations', 'slug' => 'other-organizations'],
        ];

        foreach ($categories as $index => $category) {
            OrganizationCategory::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['name'] . ' in Munshiganj district.',
                    'status' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
