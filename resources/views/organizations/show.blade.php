@extends('layouts.app')

@section('title', $organization->meta_title ?: $organization->name)

@section('meta_description', $organization->meta_description ?: $organization->short_description)

@section('content')
<div class="container py-4">

    <div class="mb-3">
        <a href="{{ route('organizations.index') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> সকল সংগঠন
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">
                @if($organization->featured_image)
                    <img
                        src="{{ asset('storage/' . $organization->featured_image) }}"
                        class="card-img-top"
                        alt="{{ $organization->name }}"
                        style="max-height: 420px; object-fit: cover;"
                    >
                @endif

                <div class="card-body p-4">

                    @if($organization->category)
                        <span class="badge bg-primary mb-2">
                            {{ $organization->category->name }}
                        </span>
                    @endif

                    <h1 class="fw-bold mb-3">{{ $organization->name }}</h1>

                    @if($organization->alternative_name)
                        <p class="text-muted">{{ $organization->alternative_name }}</p>
                    @endif

                    <div class="text-muted small mb-3">
                        <i class="bi bi-geo-alt"></i>
                        {{ $organization->upazila?->name ?? '' }},
                        {{ $organization->district?->name ?? '' }}
                    </div>

                    @if($organization->short_description)
                        <p class="lead">{{ $organization->short_description }}</p>
                    @endif

                    @if($organization->description)
                        <hr>
                        <h4 class="fw-bold">সংগঠন সম্পর্কে</h4>
                        <div>{!! nl2br(e($organization->description)) !!}</div>
                    @endif

                    @if($organization->activities)
                        <hr>
                        <h4 class="fw-bold">কার্যক্রম</h4>
                        <div>{!! nl2br(e($organization->activities)) !!}</div>
                    @endif

                    @if($organization->services)
                        <hr>
                        <h4 class="fw-bold">সেবাসমূহ</h4>
                        <div>{!! nl2br(e($organization->services)) !!}</div>
                    @endif

                    @if($organization->source)
                        <hr>
                        <p class="small text-muted">
                            <strong>তথ্যসূত্র:</strong> {{ $organization->source }}
                        </p>
                    @endif

                </div>
            </div>

            @if($relatedOrganizations->isNotEmpty())
                <div class="mt-5">
                    <h4 class="fw-bold mb-3">সম্পর্কিত সংগঠন</h4>

                    <div class="row g-3">
                        @foreach($relatedOrganizations as $related)
                            <div class="col-md-6">
                                <x-organization-card :organization="$related" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">যোগাযোগ ও তথ্য</h5>
                </div>

                <div class="card-body">

                    @if($organization->established_year)
                        <p>
                            <strong>প্রতিষ্ঠার সাল:</strong>
                            {{ $organization->established_year }}
                        </p>
                    @endif

                    @if($organization->registration_number)
                        <p>
                            <strong>নিবন্ধন নম্বর:</strong>
                            {{ $organization->registration_number }}
                        </p>
                    @endif

                    @if($organization->registration_authority)
                        <p>
                            <strong>নিবন্ধন কর্তৃপক্ষ:</strong>
                            {{ $organization->registration_authority }}
                        </p>
                    @endif

                    @if($organization->president_name)
                        <p>
                            <strong>সভাপতি:</strong>
                            {{ $organization->president_name }}
                        </p>
                    @endif

                    @if($organization->secretary_name)
                        <p>
                            <strong>সাধারণ সম্পাদক:</strong>
                            {{ $organization->secretary_name }}
                        </p>
                    @endif

                    @if($organization->contact_person)
                        <p>
                            <strong>যোগাযোগ ব্যক্তি:</strong>
                            {{ $organization->contact_person }}
                        </p>
                    @endif

                    @if($organization->address)
                        <p>
                            <strong>ঠিকানা:</strong><br>
                            {{ $organization->address }}
                        </p>
                    @endif

                    @if($organization->phone)
                        <p>
                            <strong>ফোন:</strong>
                            <a href="tel:{{ $organization->phone }}">
                                {{ $organization->phone }}
                            </a>
                        </p>
                    @endif

                    @if($organization->email)
                        <p>
                            <strong>ইমেইল:</strong>
                            <a href="mailto:{{ $organization->email }}">
                                {{ $organization->email }}
                            </a>
                        </p>
                    @endif

                    @if($organization->website)
                        <p>
                            <strong>ওয়েবসাইট:</strong><br>
                            <a href="{{ $organization->website }}" target="_blank" rel="noopener noreferrer">
                                {{ $organization->website }}
                            </a>
                        </p>
                    @endif

                    <p class="small text-muted mb-0">
                        <i class="bi bi-eye"></i>
                        {{ number_format($organization->views) }} বার দেখা হয়েছে
                    </p>

                </div>
            </div>

            @if($organization->latitude && $organization->longitude)
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">অবস্থান</h5>

                        <a
                            href="https://www.google.com/maps?q={{ $organization->latitude }},{{ $organization->longitude }}"
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