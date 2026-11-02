<?php

namespace App\Http\Controllers;

use App\Models\HistoricalPlace;
use App\Models\HistoricalPlaceCategory;
use Illuminate\Http\Request;

class HistoricalPlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = HistoricalPlace::publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('alternative_name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category)
                    ->where('status', true);
            });
        }

        $places = $query->paginate(12)->withQueryString();

        $categories = HistoricalPlaceCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view('historical-places.index', compact(
            'places',
            'categories'
        ));
    }

    public function show(HistoricalPlace $historicalPlace)
    {
        abort_unless($historicalPlace->isPubliclyVisible(), 404);

        $historicalPlace->increment('views');

        $historicalPlace->load([
            'category',
            'district',
            'upazila',
            'images',
        ]);

        $relatedPlaces = HistoricalPlace::publiclyVisible()
            ->where('id', '!=', $historicalPlace->id)
            ->where('historical_place_category_id',
                $historicalPlace->historical_place_category_id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->take(4)
            ->get();

        return view('historical-places.show', compact(
            'historicalPlace',
            'relatedPlaces'
        ));
    }

    public function category(HistoricalPlaceCategory $category)
    {
        abort_unless($category->status, 404);

        $places = HistoricalPlace::publiclyVisible()
            ->where('historical_place_category_id', $category->id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->paginate(12);

        $categories = HistoricalPlaceCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view('historical-places.index', compact(
            'places',
            'categories',
            'category'
        ));
    }
}
