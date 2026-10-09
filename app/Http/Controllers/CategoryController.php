<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
{
    $news = $category->news()
        ->where('status', 'published')
        ->latest('published_at')
        ->paginate(12);

    return view('categories.show', compact(
        'category',
        'news'
    ));
}
}