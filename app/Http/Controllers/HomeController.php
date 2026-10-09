<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\District;


class HomeController extends Controller
{
    public function index()
    {
       $featuredNews = News::query()
            ->where('status', 'published')
            ->where('is_featured', true)
            ->with(['category', 'district'])
            ->latest('published_at')
            ->first();

        $latestNews = News::query()
            ->where('status', 'published')
            ->with(['category', 'district'])
            ->latest('published_at')
            ->paginate(9);

        $categories = Category::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $districts = District::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('home', compact(
            'featuredNews',
            'latestNews',
            'categories',
            'districts'
        ));
    }
}
