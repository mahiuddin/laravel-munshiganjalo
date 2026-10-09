<?php

namespace App\Http\Controllers;
use App\Models\District;

use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function show(District $district)
{
    $news = $district->news()
        ->where('status', 'published')
        ->latest('published_at')
        ->paginate(12);

    $upazilas = $district->upazilas()
        ->where('status', true)
        ->orderBy('name')
        ->get();

    return view('districts.show', compact(
        'district',
        'news',
        'upazilas'
    ));
}
}

