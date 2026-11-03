@extends('layouts.app')

@section('title', $mediaOutlet->meta_title ?: $mediaOutlet->name)

@section('meta_description', $mediaOutlet->meta_description ?: $mediaOutlet->short_description)

@section('content')
<div class="container py-4">

    <div class="mb-3">
        <a href="{{ route('media-outlets.index') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> সকল গণমাধ্যম
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                @if($mediaOutlet->featured_image)
                    <img
                        src="{{ asset('storage/' . $mediaOutlet->featured_image) }}"
                        class="card-img-top"
                        alt="{{ $mediaOutlet->name }}"
                        style="max-height: 420px; object-fit: cover;"
                    >
                @endif

                <div class="card-body p-4">

                    @if($mediaOutlet->category)
                        <span class="badge bg-primary mb-2">
                            {{ $mediaOutlet->category->name }}
                        </span>
                    @endif

                    <h1 class="fw-bold mb-3">{{ $mediaOutlet->name }}</h1>

                    @if($mediaOutlet->alternative_name)
                        <p class="text-muted">{{ $mediaOutlet->alternative_name }}</p>
                    @endif

                    <p class="text-muted small">
                        <i class="bi bi-geo-alt"></i>
                        {{ $mediaOutlet->upazila?->name ?? '' }},
                        {{ $mediaOutlet->district?->name ?? '' }}
                    </p>

                    @if($mediaOutlet->short_description)
                        <p class="lead">{{ $mediaOutlet->short_description }}</p>
                    @endif

                    @if($mediaOutlet->description)
                        <hr>
                        <h4 class="fw-bold">গণমাধ্যম সম্পর্কে</h4>
                        <div>{!! nl2br(e($mediaOutlet->description)) !!}</div>
                    @endif

                    @if($mediaOutlet->coverage_area)
                        <hr>
                        <h4 class="fw-bold">সংবাদ প্রচারের এলাকা</h4>
                        <div>{!! nl2br(e($mediaOutlet->coverage_area)) !!}</div>
                    @endif

                    @if($mediaOutlet->source)
                        <hr>
                        <p class="small text-muted">
                            <strong>তথ্যসূত্র:</strong> {{ $mediaOutlet->source }}
                        </p>
                    @endif

                </div>
            </div>

            @if($relatedMediaOutlets->isNotEmpty())
                <div class="mt-5">
                    <h4 class="fw-bold mb-3">সম্পর্কিত গণমাধ্যম</h4>

                    <div class="row g-3">
                        @foreach($relatedMediaOutlets as $related)
                            <div class="col-md-6">
                                <x-media-outlet-card :media-outlet="$related" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">যোগাযোগ ও তথ্য</h5>
                </div>

                <div class="card-body">

                    @if($mediaOutlet->language)
                        <p><strong>ভাষা:</strong> {{ $mediaOutlet->language }}</p>
                    @endif

                    @if($mediaOutlet->publication_frequency)
                        <p><strong>প্রকাশনার ধরন:</strong> {{ $mediaOutlet->publication_frequency }}</p>
                    @endif

                    @if($mediaOutlet->established_year)
                        <p><strong>প্রতিষ্ঠার সাল:</strong> {{ $mediaOutlet->established_year }}</p>
                    @endif

                    @if($mediaOutlet->owner_name)
                        <p><strong>মালিক:</strong> {{ $mediaOutlet->owner_name }}</p>
                    @endif

                    @if($mediaOutlet->editor_name)
                        <p><strong>সম্পাদক:</strong> {{ $mediaOutlet->editor_name }}</p>
                    @endif

                    @if($mediaOutlet->contact_person)
                        <p><strong>যোগাযোগ ব্যক্তি:</strong> {{ $mediaOutlet->contact_person }}</p>
                    @endif

                    @if($mediaOutlet->address)
                        <p><strong>ঠিকানা:</strong><br>{{ $mediaOutlet->address }}</p>
                    @endif

                    @if($mediaOutlet->phone)
                        <p>
                            <strong>ফোন:</strong>
                            <a href="tel:{{ $mediaOutlet->phone }}">{{ $mediaOutlet->phone }}</a>
                        </p>
                    @endif

                    @if($mediaOutlet->email)
                        <p>
                            <strong>ইমেইল:</strong>
                            <a href="mailto:{{ $mediaOutlet->email }}">{{ $mediaOutlet->email }}</a>
                        </p>
                    @endif

                    @if($mediaOutlet->website)
                        <p>
                            <strong>ওয়েবসাইট:</strong><br>
                            <a href="{{ $mediaOutlet->website }}" target="_blank" rel="noopener noreferrer">
                                {{ $mediaOutlet->website }}
                            </a>
                        </p>
                    @endif

                    @if($mediaOutlet->facebook_url)
                        <p>
                            <strong>Facebook:</strong><br>
                            <a href="{{ $mediaOutlet->facebook_url }}" target="_blank" rel="noopener noreferrer">
                                Facebook Page
                            </a>
                        </p>
                    @endif

                    @if($mediaOutlet->youtube_url)
                        <p>
                            <strong>YouTube:</strong><br>
                            <a href="{{ $mediaOutlet->youtube_url }}" target="_blank" rel="noopener noreferrer">
                                YouTube Channel
                            </a>
                        </p>
                    @endif

                    <p class="small text-muted mb-0">
                        <i class="bi bi-eye"></i>
                        {{ number_format($mediaOutlet->views) }} বার দেখা হয়েছে
                    </p>

                </div>
            </div>

            @if($mediaOutlet->latitude && $mediaOutlet->longitude)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="fw-bold">অবস্থান</h5>

                        <a
                            href="https://www.google.com/maps?q={{ $mediaOutlet->latitude }},{{ $mediaOutlet->longitude }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-outline-primary w-100"
                        >
                            <i class="bi bi-map"></i> Google Maps-এ দেখুন
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection