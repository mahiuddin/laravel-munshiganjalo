
@extends('layouts.app')

@section('title', $upazila->name . ' উপজেলার খবর | মুন্সিগঞ্জ আলো')

@section('content')
<div class="container py-5">
    <p class="text-secondary mb-1">
        <a href="{{ route('district.show', $upazila->district->slug) }}">
            {{ $upazila->district->name }}
        </a>
        / {{ $upazila->name }}
    </p>

    <h1 class="section-title">{{ $upazila->name }} উপজেলার খবর</h1>

    <div class="row g-4">
        @forelse ($news as $item)
            <div class="col-sm-6 col-lg-4">
                <x-news-card :news="$item" />
            </div>
        @empty
            <p class="text-secondary">এই উপজেলার কোনো প্রকাশিত সংবাদ নেই।</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $news->links() }}</div>
</div>
@endsection