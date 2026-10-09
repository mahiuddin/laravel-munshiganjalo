
@extends('layouts.app')

@section('title', $category->name . ' | মুন্সিগঞ্জ আলো')

@section('content')
<div class="container py-5">
    <h1 class="section-title">{{ $category->name }}</h1>

    @if ($category->description)
        <p class="text-secondary mb-4">{{ $category->description }}</p>
    @endif

    <div class="row g-4">
        @forelse ($news as $item)
            <div class="col-sm-6 col-lg-4">
                <x-news-card :news="$item" />
            </div>
        @empty
            <p class="text-secondary">এই বিভাগে এখনো কোনো সংবাদ নেই।</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $news->links() }}</div>
</div>
@endsection