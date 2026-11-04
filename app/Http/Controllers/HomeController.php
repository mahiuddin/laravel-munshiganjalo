<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\District;
use App\Models\Personality;
use App\Models\HistoricalPlace;
use App\Models\EducationInstitution;
use App\Models\Organization;
use App\Models\MediaOutlet;
use App\Models\DirectoryEntry;

class HomeController extends Controller
{
    public function index()
    {
        // Featured News
        $featuredNews = News::query()
            ->where('status', 'published')
            ->where('is_featured', true)
            ->with(['category', 'district'])
            ->latest('published_at')
            ->first();

        // Latest News
        $latestNews = News::query()
            ->where('status', 'published')
            ->with(['category', 'district'])
            ->latest('published_at')
            ->paginate(9);

        // News Categories
        $categories = Category::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        // Districts
        $districts = District::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        // Personalities
        $personalities = Personality::query()
            ->publiclyVisible()
            ->with('category')
            ->latest()
            ->limit(6)
            ->get();

        // Historical Places
        $historicalPlaces = HistoricalPlace::query()
            ->publiclyVisible()
            ->with('category')
            ->latest()
            ->limit(6)
            ->get();

        // Education Institutions
        $educationInstitutions = EducationInstitution::query()
            ->publiclyVisible()
            ->with('category')
            ->latest()
            ->limit(6)
            ->get();

        // Organizations
        $organizations = Organization::query()
            ->publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->limit(6)
            ->get();

        // Media Outlets
        $mediaOutlets = MediaOutlet::query()
            ->publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->limit(6)
            ->get();

        // Public Directory
        $directoryEntries = DirectoryEntry::query()
            ->publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->limit(6)
            ->get();

        return view('home', compact(
            'featuredNews',
            'latestNews',
            'categories',
            'districts',
            'personalities',
            'historicalPlaces',
            'educationInstitutions',
            'organizations',
            'mediaOutlets',
            'directoryEntries'
        ));
    }
}