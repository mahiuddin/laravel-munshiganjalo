<?php

namespace Database\Seeders;

use App\Models\MediaOutletCategory;
use Illuminate\Database\Seeder;

class MediaOutletCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Newspaper', 'slug' => 'newspaper'],
            ['name' => 'Online News Portal', 'slug' => 'online-news-portal'],
            ['name' => 'Television', 'slug' => 'television'],
            ['name' => 'Radio', 'slug' => 'radio'],
            ['name' => 'Magazine', 'slug' => 'magazine'],
            ['name' => 'News Agency', 'slug' => 'news-agency'],
            ['name' => 'Community Media', 'slug' => 'community-media'],
        ];

        foreach ($categories as $index => $category) {
            MediaOutletCategory::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['name'] . ' serving Munshiganj.',
                    'status' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
