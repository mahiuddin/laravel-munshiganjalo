<?php

namespace App\Http\Controllers;

use App\Models\Personality;
use App\Models\PersonalityCategory;
use Illuminate\Http\Request;

class PersonalityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->trim()->toString();

        $personalities = Personality::query()
            ->publiclyVisible()
            ->with(['category', 'district', 'upazila'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('designation', 'like', "%{$search}%")
                        ->orWhere('short_bio', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = PersonalityCategory::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('personalities.index', compact(
            'personalities',
            'categories',
            'search'
        ));
    }

    public function show(Personality $personality)
    {
        abort_unless($personality->isPubliclyVisible(), 404);

        $personality->increment('views');

        $personality->load([
            'category',
            'district',
            'upazila',
        ]);

        $relatedPersonalities = Personality::query()
            ->publiclyVisible()
            ->where('id', '!=', $personality->id)
            ->where(
                'personality_category_id',
                $personality->personality_category_id
            )
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->take(4)
            ->get();

        return view('personalities.show', compact(
            'personality',
            'relatedPersonalities'
        ));
    }

    public function category(PersonalityCategory $category)
    {
        abort_unless($category->status, 404);

        $personalities = Personality::query()
            ->publiclyVisible()
            ->where('personality_category_id', $category->id)
            ->with(['category', 'district', 'upazila'])
            ->latest()
            ->paginate(12);

        $categories = PersonalityCategory::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $search = '';

        return view('personalities.index', compact(
            'personalities',
            'categories',
            'category',
            'search'
        ));
    }
}
