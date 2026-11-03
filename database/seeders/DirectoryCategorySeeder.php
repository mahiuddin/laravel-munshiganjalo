<?php

namespace Database\Seeders;

use App\Models\DirectoryCategory;
use Illuminate\Database\Seeder;

class DirectoryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Government Offices', 'slug' => 'government-offices'],
            ['name' => 'Hospitals & Clinics', 'slug' => 'hospitals-clinics'],
            ['name' => 'Police Stations', 'slug' => 'police-stations'],
            ['name' => 'Fire Stations', 'slug' => 'fire-stations'],
            ['name' => 'Banks & Financial Institutions', 'slug' => 'banks-financial-institutions'],
            ['name' => 'Emergency Services', 'slug' => 'emergency-services'],
            ['name' => 'NGOs & Social Services', 'slug' => 'ngos-social-services'],
            ['name' => 'Public Utilities', 'slug' => 'public-utilities'],
        ];

        foreach ($categories as $index => $category) {
            DirectoryCategory::firstOrCreate(
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
