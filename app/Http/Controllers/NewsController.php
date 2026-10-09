<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        abort_if($news->status !== 'published', 404);

        $news->increment('views');

        $relatedNews = News::query()
            ->where('status', 'published')
            ->where('id', '!=', $news->id)
            ->where('category_id', $news->category_id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('news.show', compact(
            'news',
            'relatedNews'
        ));
    }
}