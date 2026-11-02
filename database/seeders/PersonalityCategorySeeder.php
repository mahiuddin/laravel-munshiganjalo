<?php

namespace Database\Seeders;

use App\Models\PersonalityCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PersonalityCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'language-movement-activists' => 'ভাষা আন্দোলনের কর্মী',
            'freedom-fighters' => 'মুক্তিযোদ্ধা',
            'politicians' => 'রাজনীতিবিদ',
            'educationists' => 'শিক্ষাবিদ',
            'writers' => 'লেখক ও সাহিত্যিক',
            'artists' => 'শিল্পী ও সংস্কৃতিকর্মী',
            'scientists' => 'বিজ্ঞানী ও গবেষক',
            'social-workers' => 'সমাজসেবক',
            'religious-figures' => 'ধর্মীয় ব্যক্তিত্ব',
            'sports-personalities' => 'ক্রীড়াবিদ',
            'entrepreneurs' => 'উদ্যোক্তা ও ব্যবসায়ী',
            'expatriates' => 'প্রবাসী ব্যক্তিত্ব',
        ];

        foreach ($categories as $slug => $name) {
            PersonalityCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'status' => true,
                ]
            );
        }
    }
}