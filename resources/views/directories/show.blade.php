@extends('layouts.app')

@section('title', $directoryEntry->meta_title ?: $directoryEntry->name)

@section('meta_description', $directoryEntry->meta_description ?: $directoryEntry->short_description)

@section('content')
<div class="container py-4">

    <div class="mb-3">
        <a href="{{ route('directories.index') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> পাবলিক ডিরেক্টরি
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                @if($directoryEntry->featured_image)
                    <img
                        src="{{ asset('storage/' . $directoryEntry->featured_image) }}"
                        class="card-img-top"
                        alt="{{ $directoryEntry->name }}"
                        style="max-height: 420px; object-fit: cover;"
                    >
                @endif

                <div class="card-body p-4">

                    @if($directoryEntry->category)
                        <span class="badge bg-primary mb-2">
                            {{ $directoryEntry->category->name }}
                        </span>
                    @endif

                    <h1 class="fw-bold mb-3">{{ $directoryEntry->name }}</h1>

                    @if($directoryEntry->alternative_name)
                        <p class="text-muted">{{ $directoryEntry->alternative_name }}</p>
                    @endif

                    <p class="text-muted small">
                        <i class="bi bi-geo-alt"></i>
                        {{ $directoryEntry->upazila?->name ?? '' }},
                        {{ $directoryEntry->district?->name ?? '' }}
                    </p>

                    @if($directoryEntry->short_description)
                        <p class="lead">{{ $directoryEntry->short_description }}</p>
                    @endif

                    @php
                        $description = trim(strip_tags($directoryEntry->description ?? ''));
                    @endphp

                    @if($description !== '')
                        <hr>
                        <h4 class="fw-bold">প্রতিষ্ঠান সম্পর্কে</h4>
                        <div>{!! $directoryEntry->description !!}</div>
                    @endif

                    @php
                        $services = trim(strip_tags($directoryEntry->services ?? ''));
                    @endphp

                    @if($services !== '')
                        <hr>
                        <h4 class="fw-bold">সেবাসমূহ</h4>
                        <div>{!! $directoryEntry->services !!}</div>
                    @endif

                    @if($directoryEntry->opening_hours)
                        <hr>
                        <h4 class="fw-bold">খোলা থাকার সময়</h4>
                        <div>{!! nl2br(e($directoryEntry->opening_hours)) !!}</div>
                    @endif

                    @if($directoryEntry->source)
                        <hr>
                        <p class="small text-muted">
                            <strong>তথ্যসূত্র:</strong> {{ $directoryEntry->source }}
                        </p>
                    @endif

                </div>
            </div>

            @if($relatedDirectoryEntries->isNotEmpty())
                <div class="mt-5">
                    <h4 class="fw-bold mb-3">সম্পর্কিত প্রতিষ্ঠান</h4>

                    <div class="row g-3">
                        @foreach($relatedDirectoryEntries as $related)
                            <div class="col-md-6">
                                <x-directory-entry-card :directory-entry="$related" />
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

                    @if($directoryEntry->contact_person)
                        <p><strong>যোগাযোগ ব্যক্তি:</strong> {{ $directoryEntry->contact_person }}</p>
                    @endif

                    @if($directoryEntry->designation)
                        <p><strong>পদবি:</strong> {{ $directoryEntry->designation }}</p>
                    @endif

                    @if($directoryEntry->address)
                        <p><strong>ঠিকানা:</strong><br>{{ $directoryEntry->address }}</p>
                    @endif

                    @if($directoryEntry->phone)
                        <p>
                            <strong>ফোন:</strong>
                            <a href="tel:{{ $directoryEntry->phone }}">{{ $directoryEntry->phone }}</a>
                        </p>
                    @endif

                    @if($directoryEntry->emergency_phone)
                        <p>
                            <strong>জরুরি ফোন:</strong>
                            <a href="tel:{{ $directoryEntry->emergency_phone }}">
                                {{ $directoryEntry->emergency_phone }}
                            </a>
                        </p>
                    @endif

                    @if($directoryEntry->email)
                        <p>
                            <strong>ইমেইল:</strong>
                            <a href="mailto:{{ $directoryEntry->email }}">{{ $directoryEntry->email }}</a>
                        </p>
                    @endif

                    @if($directoryEntry->website)
                        <p>
                            <strong>ওয়েবসাইট:</strong><br>
                            <a href="{{ $directoryEntry->website }}" target="_blank" rel="noopener noreferrer">
                                {{ $directoryEntry->website }}
                            </a>
                        </p>
                    @endif

                    <p class="small text-muted mb-0">
                        <i class="bi bi-eye"></i>
                        {{ number_format($directoryEntry->views) }} বার দেখা হয়েছে
                    </p>

                </div>
            </div>

            @if($directoryEntry->latitude && $directoryEntry->longitude)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="fw-bold">অবস্থান</h5>

                        <a
                            href="https://www.google.com/maps?q={{ $directoryEntry->latitude }},{{ $directoryEntry->longitude }}"
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