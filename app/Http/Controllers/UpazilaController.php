<?php

namespace App\Http\Controllers;
use App\Models\Upazila;

use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function show(Upazila $upazila)
{
    $news = $upazila->news()
        ->where('status', 'published')
        ->latest('published_at')
        ->paginate(12);

    return view('upazilas.show', compact(
        'upazila',
        'news'
    ));
}
}
