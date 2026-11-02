
@extends('layouts.app')

@section('title', $information->meta_title ?: 'জেলা পরিচিতি')

@section('content')
<div class="container py-5">

    <header class="text-center mb-5">
        <h1 class="fw-bold">
            {{ $information->district->name }} জেলা পরিচিতি
        </h1>

        @if($information->tagline)
            <p class="lead text-muted">{{ $information->tagline }}</p>
        @endif
    </header>

    @if($information->featured_image)
        <img src="{{ asset('storage/' . $information->featured_image) }}"
             class="img-fluid rounded w-100 mb-4"
             style="max-height:450px; object-fit:cover;"
             alt="{{ $information->district->name }}">
    @endif

    <div class="row g-4 mb-5">
        @foreach([
            'আয়তন' => $information->area,
            'জনসংখ্যা' => $information->population,
            'জনসংখ্যার বছর' => $information->population_year,
            'জনঘনত্ব' => $information->density,
            'প্রতিষ্ঠা' => $information->established_year,
            'পোস্ট কোড' => $information->postal_code,
        ] as $label => $value)
            @if($value)
                <div class="col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <small class="text-muted">{{ $label }}</small>
                            <h5 class="mb-0">{{ $value }}</h5>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @foreach([
        'overview' => 'জেলার পরিচিতি',
        'history' => 'ইতিহাস',
        'geography' => 'ভৌগোলিক অবস্থান',
        'economy' => 'অর্থনীতি',
        'culture' => 'সংস্কৃতি',
        'communication' => 'যোগাযোগ ব্যবস্থা',
        'rivers' => 'নদ-নদী',
        'education' => 'শিক্ষা',
        'administration' => 'প্রশাসনিক তথ্য',
        'tourism' => 'দর্শনীয় স্থান ও পর্যটন',
    ] as $field => $heading)

        @if($information->$field)
            <section class="mb-5">
                <h2 class="h3 mb-3">{{ $heading }}</h2>
                <div>{!! $information->$field !!}</div>
            </section>
        @endif

    @endforeach

    @if($information->sources)
        <section class="border-top pt-4">
            <h4>তথ্যসূত্র</h4>
            <p>{{ $information->sources }}</p>
        </section>
    @endif

</div>
@endsection
