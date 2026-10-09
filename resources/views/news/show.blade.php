
@extends('layouts.app')

@section('title', $news->title . ' | মুন্সিগঞ্জ আলো')

@section('meta_description', $news->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($news->content), 155))

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <article class="content-panel p-3 p-md-5">
                @if ($news->category)
                    <a class="category-pill"
                       href="{{ route('category.show', $news->category->slug) }}">
                        {{ $news->category->name }}
                    </a>
                @endif

                <h1 class="fw-bold mt-3 mb-3">{{ $news->title }}</h1>

                <div class="news-meta mb-4">
                    @if ($news->district)
                        <a href="{{ route('district.show', $news->district->slug) }}">
                            {{ $news->district->name }}
                        </a>
                    @endif

                    @if ($news->upazila)
                        · <a href="{{ route('upazila.show', $news->upazila->slug) }}">
                            {{ $news->upazila->name }}
                        </a>
                    @endif

                    @if ($news->published_at)
                        · {{ $news->published_at->locale('bn')->translatedFormat('j F Y') }}
                    @endif

                    · পঠিত {{ number_format($news->views) }} বার
                </div>

                @if ($news->featured_image)
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($news->featured_image) }}"
                        alt="{{ $news->title }}"
                        class="img-fluid rounded mb-4 w-100">
                @endif

                @if ($news->excerpt)
                    <p class="lead fw-medium">{{ $news->excerpt }}</p>
                @endif

                <div class="article-content">
                    {!! \Illuminate\Support\Str::markdown($news->content) !!}
                </div>
            </article>

            <div class="mt-4">
                <h2 class="section-title">আরও ভালো খবর</h2>

                <div class="row g-3">
                    @forelse ($relatedNews as $item)
                        <div class="col-md-6">
                            <x-news-card :news="$item" />
                        </div>
                    @empty
                        <p class="text-secondary">সম্পর্কিত খবর এখনো নেই।</p>
                    @endforelse
                </div>
            </div>
        </div>

        <aside class="col-lg-4">
            <div class="content-panel p-4">
                <h2 class="h5 fw-bold">মুন্সিগঞ্জ আলো</h2>
                <p class="text-secondary mb-0">
                    ইতিবাচক সংবাদ, মানবিক উদ্যোগ ও সাফল্যের গল্পের সঙ্গে থাকুন।
                </p>
            </div>
        </aside>
    </div>
</div>
@endsection