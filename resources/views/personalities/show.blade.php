@extends('layouts.app')

@section('title', $personality->name . ' | মুন্সিগঞ্জ আলো')

@section('meta_description', $personality->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($personality->short_bio ?: $personality->biography), 155))

@section('content')
<div class="container py-5">

    <div class="row g-4">

        <div class="col-lg-8">

            <article class="content-panel p-3 p-md-5">

                {{-- Category --}}
                @if ($personality->category)
                    <a
                        href="{{ route('personality-category.show', $personality->category->slug) }}"
                        class="category-pill">
                        {{ $personality->category->name }}
                    </a>
                @endif

                {{-- Name --}}
                <h1 class="fw-bold mt-3 mb-2">
                    {{ $personality->name }}
                </h1>

                @if ($personality->designation)
                    <p class="lead text-secondary mb-3">
                        {{ $personality->designation }}
                    </p>
                @endif

                {{-- Location and views --}}
                <div class="news-meta mb-4">
                    @if ($personality->district)
                        {{ $personality->district->name }}
                    @endif

                    @if ($personality->upazila)
                        · {{ $personality->upazila->name }}
                    @endif

                    · পঠিত {{ number_format($personality->views) }} বার
                </div>

                {{-- Photo --}}
                @if ($personality->photo)
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($personality->photo) }}"
                        alt="{{ $personality->name }}"
                        class="img-fluid rounded mb-4 w-100">
                @endif

                {{-- Short Biography --}}
                @if ($personality->short_bio)
                    <p class="lead fw-medium">
                        {{ $personality->short_bio }}
                    </p>
                @endif

                {{-- Personal Information --}}
                <div class="content-panel p-3 mb-4">
                    <h2 class="h5 fw-bold mb-3">ব্যক্তিগত তথ্য</h2>

                    <div class="row g-3">

                        @if ($personality->date_of_birth)
                            <div class="col-sm-6">
                                <div class="text-secondary small">জন্ম</div>
                                <strong>
                                    {{ $personality->date_of_birth->locale('bn')->translatedFormat('j F Y') }}
                                </strong>
                            </div>
                        @endif

                        @if ($personality->date_of_death)
                            <div class="col-sm-6">
                                <div class="text-secondary small">মৃত্যু</div>
                                <strong>
                                    {{ $personality->date_of_death->locale('bn')->translatedFormat('j F Y') }}
                                </strong>
                            </div>
                        @endif

                        @if ($personality->birth_place)
                            <div class="col-sm-6">
                                <div class="text-secondary small">জন্মস্থান</div>
                                <strong>{{ $personality->birth_place }}</strong>
                            </div>
                        @endif

                        @if ($personality->district)
                            <div class="col-sm-6">
                                <div class="text-secondary small">জেলা</div>
                                <strong>{{ $personality->district->name }}</strong>
                            </div>
                        @endif

                        @if ($personality->upazila)
                            <div class="col-sm-6">
                                <div class="text-secondary small">উপজেলা</div>
                                <strong>{{ $personality->upazila->name }}</strong>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Biography --}}
                @if ($personality->biography)
                    <h2 class="section-title">জীবনী ও অবদান</h2>

                    <div class="article-content">
                        {!! $personality->biography !!}
                    </div>
                @endif

                {{-- Source --}}
                @if ($personality->source)
                    <div class="mt-4 pt-3 border-top">
                        <h2 class="h5 fw-bold">তথ্যসূত্র</h2>
                        <p class="text-secondary mb-0">
                            {{ $personality->source }}
                        </p>
                    </div>
                @endif

            </article>

            {{-- Related Personalities --}}
            <div class="mt-4">
                <h2 class="section-title">সম্পর্কিত ব্যক্তিত্ব</h2>

                <div class="row g-3">
                    @forelse ($relatedPersonalities as $item)
                        <div class="col-md-6">
                            <x-personality-card :personality="$item" />
                        </div>
                    @empty
                        <p class="text-secondary">
                            এই বিভাগের অন্য কোনো ব্যক্তিত্ব এখনো প্রকাশিত হয়নি।
                        </p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Sidebar --}}
        <aside class="col-lg-4">
            <div class="content-panel p-4">
                <h2 class="h5 fw-bold">মুন্সিগঞ্জ আলো</h2>
                <p class="text-secondary mb-3">
                    মুন্সিগঞ্জের ইতিহাস, ঐতিহ্য, কৃতী মানুষ ও ইতিবাচক গল্পের তথ্যভান্ডার।
                </p>

                <a href="{{ route('personalities.index') }}"
                   class="btn btn-alo btn-sm">
                    সব ব্যক্তিত্ব দেখুন
                </a>
            </div>
        </aside>

    </div>
</div>
@endsection
