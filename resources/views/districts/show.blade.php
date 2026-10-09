
@extends('layouts.app')

@section('title', $district->name . ' জেলার খবর | মুন্সিগঞ্জ আলো')

@section('content')
<div class="container py-5">
    <h1 class="section-title">{{ $district->name }} জেলার খবর</h1>

    <h2 class="h5 mb-3">উপজেলাভিত্তিক সংবাদ</h2>

    <div class="mb-4">
        @forelse ($upazilas as $upazila)
            <a href="{{ route('upazila.show', $upazila->slug) }}"
               class="category-pill">
                {{ $upazila->name }}
            </a>
        @empty
            <p class="text-secondary">এখনো কোনো উপজেলা যোগ করা হয়নি।</p>
        @endforelse
    </div>

    <h2 class="section-title">সর্বশেষ সংবাদ</h2>

    <div class="row g-4">
        @forelse ($news as $item)
            <div class="col-sm-6 col-lg-4">
                <x-news-card :news="$item" />
            </div>
        @empty
            <p class="text-secondary">এই জেলার কোনো প্রকাশিত সংবাদ নেই।</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $news->links() }}</div>
</div>
@endsection