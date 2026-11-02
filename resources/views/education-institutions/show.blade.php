
@extends('layouts.app')

@section('title', $educationInstitution->meta_title ?: $educationInstitution->name)

@section('content')
<div class="container py-5">

    <a href="{{ route('education-institutions.index') }}"
       class="text-success text-decoration-none">
        শিক্ষা প্রতিষ্ঠান
    </a>

    <div class="row g-4 mt-2">
        <div class="col-lg-8">

            <h1 class="fw-bold">{{ $educationInstitution->name }}</h1>

            <p class="text-muted">
                {{ $educationInstitution->category?->name }}
                |
                {{ $educationInstitution->district?->name }}
                @if($educationInstitution->upazila)
                    , {{ $educationInstitution->upazila->name }}
                @endif
            </p>

            @if($educationInstitution->featured_image)
                <img src="{{ asset('storage/' . $educationInstitution->featured_image) }}"
                     class="img-fluid rounded w-100 mb-4"
                     style="max-height:450px; object-fit:cover;"
                     alt="{{ $educationInstitution->name }}">
            @endif

            @if($educationInstitution->short_description)
                <p class="lead">{{ $educationInstitution->short_description }}</p>
            @endif

            @foreach([
                'history' => 'প্রতিষ্ঠানের ইতিহাস',
                'academic_information' => 'শিক্ষা কার্যক্রম',
                'facilities' => 'সুযোগ-সুবিধা',
            ] as $field => $heading)

                @if($educationInstitution->$field)
                    <section class="mb-4">
                        <h3>{{ $heading }}</h3>
                        <div>{!! $educationInstitution->$field !!}</div>
                    </section>
                @endif

            @endforeach

            @if($educationInstitution->images->isNotEmpty())
                <h3 class="mb-3">ছবির গ্যালারি</h3>

                <div class="row g-3 mb-4">
                    @foreach($educationInstitution->images as $image)
                        <div class="col-md-4 col-6">
                            <a href="{{ asset('storage/' . $image->image) }}" target="_blank">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                     class="img-fluid rounded w-100"
                                     style="height:170px; object-fit:cover;"
                                     alt="{{ $image->caption ?: $educationInstitution->name }}">
                            </a>
                            @if($image->caption)
                                <small>{{ $image->caption }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if($educationInstitution->source)
                <section class="border-top pt-3">
                    <h5>তথ্যসূত্র</h5>
                    <p>{{ $educationInstitution->source }}</p>
                </section>
            @endif

        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>প্রতিষ্ঠানের তথ্য</h5>

                    @foreach([
                        'EIIN' => $educationInstitution->eiin,
                        'প্রতিষ্ঠাকাল' => $educationInstitution->established_year,
                        'প্রধান শিক্ষক/অধ্যক্ষ' => $educationInstitution->head_name,
                        'ঠিকানা' => $educationInstitution->address,
                        'ফোন' => $educationInstitution->phone,
                        'ইমেইল' => $educationInstitution->email,
                    ] as $label => $value)
                        @if($value)
                            <p><strong>{{ $label }}:</strong> {{ $value }}</p>
                        @endif
                    @endforeach

                    @if($educationInstitution->website)
                        <a href="{{ $educationInstitution->website }}"
                           target="_blank" rel="noopener"
                           class="btn btn-outline-success w-100 mb-2">
                            Website
                        </a>
                    @endif

                    @if($educationInstitution->latitude && $educationInstitution->longitude)
                        <a href="https://www.google.com/maps?q={{ $educationInstitution->latitude }},{{ $educationInstitution->longitude }}"
                           target="_blank" rel="noopener"
                           class="btn btn-success w-100">
                            Google Maps
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($relatedInstitutions->isNotEmpty())
        <section class="mt-5">
            <h3 class="mb-4">সম্পর্কিত শিক্ষা প্রতিষ্ঠান</h3>

            <div class="row g-4">
                @foreach($relatedInstitutions as $institution)
                    <div class="col-lg-3 col-md-6">
                        <x-education-institution-card :institution="$institution" />
                    </div>
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection
