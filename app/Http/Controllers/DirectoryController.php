<?php

namespace App\Http\Controllers;

use App\Models\DirectoryCategory;
use App\Models\DirectoryEntry;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = DirectoryEntry::publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('emergency_phone', 'like', "%{$search}%")
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

        $directoryEntries = $query->paginate(12)->withQueryString();

        $categories = DirectoryCategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('directories.index', compact(
            'directoryEntries',
            'categories'
        ));
    }

    public function show(DirectoryEntry $directoryEntry)
{
    abort_unless($directoryEntry->isPubliclyVisible(), 404);

    $directoryEntry->increment('views');

    $directoryEntry->load([
        'category',
        'district',
        'upazila',
    ]);

    $relatedDirectoryEntries = DirectoryEntry::publiclyVisible()
        ->with(['category', 'district', 'upazila'])
        ->where('directory_category_id', $directoryEntry->directory_category_id)
        ->where('id', '!=', $directoryEntry->id)
        ->latest()
        ->take(4)
        ->get();

    return view('directories.show', compact(
        'directoryEntry',
        'relatedDirectoryEntries'
    ));
}

    public function category(DirectoryCategory $category)
    {
        abort_unless($category->status, 404);

        $directoryEntries = DirectoryEntry::publiclyVisible()
            ->where('directory_category_id', $category->id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->paginate(12);

        $categories = DirectoryCategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('directories.index', compact(
            'directoryEntries',
            'categories',
            'category'
        ));
    }
}
