
@extends('layouts.app')

@section('title', $historicalPlace->meta_title ?: $historicalPlace->name)

@section('content')

<div class="container py-5">

    <div class="mb-3">
        <a href="{{ route('historical-places.index') }}"
           class="text-success text-decoration-none">
            ঐতিহাসিক স্থানসমূহ
        </a>
        /
        {{ $historicalPlace->name }}
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <h1 class="fw-bold mb-3">
                {{ $historicalPlace->name }}
            </h1>

            @if($historicalPlace->alternative_name)
                <p class="text-muted">
                    {{ $historicalPlace->alternative_name }}
                </p>
            @endif

            <div class="text-muted mb-3">
                {{ $historicalPlace->category?->name }}
                |
                {{ $historicalPlace->district?->name }}
                @if($historicalPlace->upazila)
                    , {{ $historicalPlace->upazila->name }}
                @endif
            </div>

            @if($historicalPlace->featured_image)
                <img
                    src="{{ asset('storage/' . $historicalPlace->featured_image) }}"
                    alt="{{ $historicalPlace->name }}"
                    class="img-fluid rounded mb-4 w-100"
                    style="max-height: 480px; object-fit: cover;"
                >
            @endif

            @if($historicalPlace->short_description)
                <p class="lead">
                    {{ $historicalPlace->short_description }}
                </p>
            @endif

            @if($historicalPlace->history)
                <section class="mb-4">
                    <h3>ইতিহাস ও পটভূমি</h3>
                    <div>
                        {!! $historicalPlace->history !!}
                    </div>
                </section>
            @endif

            @if($historicalPlace->historical_significance)
                <section class="mb-4">
                    <h3>ঐতিহাসিক গুরুত্ব</h3>
                    <div>
                        {!! $historicalPlace->historical_significance !!}
                    </div>
                </section>
            @endif

            @if($historicalPlace->images->isNotEmpty())
                <section class="mb-4">
                    <h3 class="mb-3">ছবির গ্যালারি</h3>

                    <div class="row g-3">
                        @foreach($historicalPlace->images as $image)
                            <div class="col-md-4 col-6">
                                <a href="{{ asset('storage/' . $image->image) }}"
                                   target="_blank">
                                    <img
                                        src="{{ asset('storage/' . $image->image) }}"
                                        class="img-fluid rounded w-100"
                                        style="height: 180px; object-fit: cover;"
                                        alt="{{ $image->caption ?: $historicalPlace->name }}"
                                    >
                                </a>

                                @if($image->caption)
                                    <small class="text-muted d-block mt-1">
                                        {{ $image->caption }}
                                    </small>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if($historicalPlace->source)
                <section class="border-top pt-3 mt-4">
                    <h5>তথ্যসূত্র</h5>
                    <p>{{ $historicalPlace->source }}</p>
                </section>
            @endif

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>স্থান সম্পর্কিত তথ্য</h5>

                    @if($historicalPlace->established_period)
                        <p>
                            <strong>প্রতিষ্ঠাকাল:</strong>
                            {{ $historicalPlace->established_period }}
                        </p>
                    @endif

                    @if($historicalPlace->founder)
                        <p>
                            <strong>প্রতিষ্ঠাতা:</strong>
                            {{ $historicalPlace->founder }}
                        </p>
                    @endif

                    @if($historicalPlace->address)
                        <p>
                            <strong>ঠিকানা:</strong>
                            {{ $historicalPlace->address }}
                        </p>
                    @endif

                    <p>
                        <strong>দর্শন সংখ্যা:</strong>
                        {{ number_format($historicalPlace->views) }}
                    </p>

                    @if($historicalPlace->latitude && $historicalPlace->longitude)
                        <a href="https://www.google.com/maps?q={{ $historicalPlace->latitude }},{{ $historicalPlace->longitude }}"
                           target="_blank"
                           rel="noopener"
                           class="btn btn-success w-100">
                            Google Maps-এ দেখুন
                        </a>
                    @endif
                </div>
            </div>

        </div>

    </div>

    @if($relatedPlaces->isNotEmpty())
        <section class="mt-5">
            <h3 class="mb-4">সম্পর্কিত ঐতিহাসিক স্থান</h3>

            <div class="row g-4">
                @foreach($relatedPlaces as $place)
                    <div class="col-lg-3 col-md-6">
                        <x-historical-place-card :place="$place" />
                    </div>
                @endforeach
            </div>
        </section>
    @endif

</div>

@endsection
