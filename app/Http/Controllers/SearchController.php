<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $news = News::query()
            ->where('status', 'published')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->with(['category', 'district'])
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('search', compact('news', 'search'));
    }
}