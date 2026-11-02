<?php

namespace App\Http\Controllers;

use App\Models\EducationCategory;
use App\Models\EducationInstitution;
use Illuminate\Http\Request;

class EducationInstitutionController extends Controller
{
    public function index(Request $request)
    {
        $query = EducationInstitution::publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('eiin', 'like', "%{$search}%")
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

        $institutions = $query->paginate(12)->withQueryString();

        $categories = EducationCategory::where('status', true)
            ->orderBy('name')->get();

        return view('education-institutions.index', compact(
            'institutions',
            'categories'
        ));
    }

    public function show(EducationInstitution $educationInstitution)
    {
        abort_unless($educationInstitution->isPubliclyVisible(), 404);

        $educationInstitution->increment('views');

        $educationInstitution->load([
            'category',
            'district',
            'upazila',
            'images',
        ]);

        $relatedInstitutions = EducationInstitution::publiclyVisible()
            ->where('id', '!=', $educationInstitution->id)
            ->where('education_category_id', $educationInstitution->education_category_id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->take(4)
            ->get();

        return view('education-institutions.show', compact(
            'educationInstitution',
            'relatedInstitutions'
        ));
    }

    public function category(EducationCategory $category)
    {
        abort_unless($category->status, 404);

        $institutions = EducationInstitution::publiclyVisible()
            ->where('education_category_id', $category->id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->paginate(12);

        $categories = EducationCategory::where('status', true)->get();

        return view('education-institutions.index', compact(
            'institutions',
            'categories',
            'category'
        ));
    }
}
