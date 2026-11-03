<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationCategory;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $query = Organization::publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
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

        $organizations = $query->paginate(12)->withQueryString();

        $categories = OrganizationCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view('organizations.index', compact(
            'organizations',
            'categories'
        ));
    }

    public function show(Organization $organization)
    {
        abort_unless($organization->isPubliclyVisible(), 404);

        $organization->increment('views');

        $organization->load(['category', 'district', 'upazila']);

        $relatedOrganizations = Organization::publiclyVisible()
            ->where('id', '!=', $organization->id)
            ->where('organization_category_id', $organization->organization_category_id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->take(4)
            ->get();

        return view('organizations.show', compact(
            'organization',
            'relatedOrganizations'
        ));
    }

    public function category(OrganizationCategory $category)
    {
        abort_unless($category->status, 404);

        $organizations = Organization::publiclyVisible()
            ->where('organization_category_id', $category->id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->paginate(12);

        $categories = OrganizationCategory::where('status', true)
            ->orderBy('name')
            ->get();

        return view('organizations.index', compact(
            'organizations',
            'categories',
            'category'
        ));
    }
}
