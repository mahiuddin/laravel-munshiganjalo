
@extends('layouts.app')

@section('title', 'মুন্সিগঞ্জ আলো | ভালো খবরের আলো')

@section('content')
<div class="container py-4">

    {{-- Welcome banner --}}
    <section class="hero-panel p-4 p-lg-5 mb-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="badge text-bg-warning mb-3">ইতিবাচক সংবাদ</span>
                <h1 class="display-5 fw-bold">
                    ভালো খবরের আলো ছড়িয়ে পড়ুক সর্বত্র
                </h1>
                <p class="lead mb-4">
                    মানুষের সাফল্য, মানবিকতা, শিক্ষা ও সমাজের
                    ইতিবাচক পরিবর্তনের গল্প জানুন মুন্সিগঞ্জ আলোতে।
                </p>
                <a href="{{ route('news.index') }}"
                   class="btn btn-light btn-lg fw-semibold">
                    সব খবর পড়ুন →
                </a>
            </div>

            <div class="col-lg-4 text-center d-none d-lg-block">
                <div style="font-size: 8rem; line-height: 1">☀</div>
                <p class="mb-0">প্রতিটি ভালো উদ্যোগই পরিবর্তনের আলো</p>
            </div>
        </div>
    </section>

    {{-- Featured story --}}
    @if ($featuredNews)
        <section class="mb-5">
            <h2 class="section-title">বিশেষ সংবাদ</h2>

            <div class="content-panel overflow-hidden">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6">
                        @if ($featuredNews->featured_image)
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($featuredNews->featured_image) }}"
                                alt="{{ $featuredNews->title }}"
                                class="w-100"
                                style="height:320px;object-fit:cover">
                        @else
                            <div class="news-placeholder"
                                 style="height:320px;aspect-ratio:auto">
                                ✦
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6 p-4 p-lg-5">
                        @if ($featuredNews->category)
                            <span class="category-pill">
                                {{ $featuredNews->category->name }}
                            </span>
                        @endif

                        <h2 class="fw-bold mt-3">
                            <a class="text-decoration-none text-dark"
                               href="{{ route('news.show', $featuredNews->slug) }}">
                                {{ $featuredNews->title }}
                            </a>
                        </h2>

                        <p class="text-secondary">
                            {{ $featuredNews->excerpt
                                ?: \Illuminate\Support\Str::limit(strip_tags($featuredNews->content), 200) }}
                        </p>

                        <a class="btn btn-alo"
                           href="{{ route('news.show', $featuredNews->slug) }}">
                            বিস্তারিত পড়ুন
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Latest stories --}}
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">সর্বশেষ ভালো খবর</h2>
            <a href="{{ route('news.index') }}"
               class="text-decoration-none fw-semibold">
                সব খবর →
            </a>
        </div>

        <div class="row g-4">
            @forelse ($latestNews as $item)
                <div class="col-sm-6 col-lg-4">
                    <x-news-card :news="$item" />
                </div>
            @empty
                <div class="col-12">
                    <div class="content-panel p-4 text-center">
                        <h3 class="h5">এখনো কোনো খবর প্রকাশিত হয়নি</h3>
                        <p class="mb-0 text-secondary">
                            অ্যাডমিন প্যানেল থেকে খবর প্রকাশ করলে এখানে দেখা যাবে।
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $latestNews->links() }}
        </div>
    </section>

    {{-- Categories --}}
    <section class="mb-5">
        <h2 class="section-title">বিষয়ভিত্তিক সংবাদ</h2>

        <div class="content-panel p-3 p-md-4">
            @forelse ($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}"
                   class="category-pill">
                    {{ $category->name }}
                </a>
            @empty
                <p class="text-secondary mb-0">
                    সংবাদ বিভাগগুলো শিগগিরই যুক্ত করা হবে।
                </p>
            @endforelse
        </div>
    </section>

    {{-- District news --}}
    <section class="mb-4">
        <h2 class="section-title">এলাকাভিত্তিক সংবাদ</h2>

        <div class="row g-4">
            @forelse ($districts as $district)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('district.show', $district->slug) }}"
                       class="content-panel p-3 d-block text-decoration-none h-100">
                        <h3 class="h5 mb-1">{{ $district->name }}</h3>
                        <span class="text-secondary small">এলাকার খবর পড়ুন →</span>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-secondary">
                        জেলা অনুযায়ী খবর দেখতে পরে জেলা নির্বাচন করা যাবে।
                    </p>
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection