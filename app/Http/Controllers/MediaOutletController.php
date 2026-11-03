<?php

namespace App\Http\Controllers;

use App\Models\MediaOutlet;
use App\Models\MediaOutletCategory;
use Illuminate\Http\Request;

class MediaOutletController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaOutlet::publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('owner_name', 'like', "%{$search}%")
                    ->orWhere('editor_name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) =>
                $q->where('slug', $request->category)
                    ->where('status', true)
            );
        }

        if ($request->filled('upazila_id')) {
            $query->where('upazila_id', $request->upazila_id);
        }

        $mediaOutlets = $query->paginate(12)->withQueryString();

        $categories = MediaOutletCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view('media-outlets.index', compact(
            'mediaOutlets',
            'categories'
        ));
    }

    public function show(MediaOutlet $mediaOutlet)
    {
        abort_unless($mediaOutlet->isPubliclyVisible(), 404);

        $mediaOutlet->increment('views');

        $mediaOutlet->load(['category', 'district', 'upazila']);

        $relatedMediaOutlets = MediaOutlet::publiclyVisible()
            ->where('id', '!=', $mediaOutlet->id)
            ->where('media_outlet_category_id', $mediaOutlet->media_outlet_category_id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->take(4)
            ->get();

        return view('media-outlets.show', compact(
            'mediaOutlet',
            'relatedMediaOutlets'
        ));
    }

    public function category(MediaOutletCategory $category)
    {
        abort_unless($category->status, 404);

        $mediaOutlets = MediaOutlet::publiclyVisible()
            ->where('media_outlet_category_id', $category->id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->paginate(12);

        $categories = MediaOutletCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view('media-outlets.index', compact(
            'mediaOutlets',
            'categories',
            'category'
        ));
    }
}
