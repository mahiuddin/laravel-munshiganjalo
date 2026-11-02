<?php

namespace Database\Seeders;

use App\Models\EducationCategory;
use Illuminate\Database\Seeder;

class EducationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'প্রাথমিক বিদ্যালয়', 'slug' => 'primary-schools'],
            ['name' => 'মাধ্যমিক বিদ্যালয়', 'slug' => 'secondary-schools'],
            ['name' => 'উচ্চ বিদ্যালয়', 'slug' => 'high-schools'],
            ['name' => 'কলেজ', 'slug' => 'colleges'],
            ['name' => 'বিশ্ববিদ্যালয়', 'slug' => 'universities'],
            ['name' => 'কওমি মাদ্রাসা', 'slug' => 'qawmi-madrasas'],
            ['name' => 'আলিয়া মাদ্রাসা', 'slug' => 'alia-madrasas'],
            ['name' => 'কিন্ডারগার্টেন', 'slug' => 'kindergartens'],
            ['name' => 'কারিগরি শিক্ষা প্রতিষ্ঠান', 'slug' => 'technical-institutions'],
            ['name' => 'ভোকেশনাল প্রতিষ্ঠান', 'slug' => 'vocational-institutions'],
            ['name' => 'অন্যান্য শিক্ষা প্রতিষ্ঠান', 'slug' => 'other-institutions'],
        ];

        foreach ($categories as $category) {
            EducationCategory::updateOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name'], 'status' => true]
            );
        }
    }
}
