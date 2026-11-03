<div class="card h-100 shadow-sm border-0">

    @if($organization->featured_image)
        <img
            src="{{ asset('storage/' . $organization->featured_image) }}"
            class="card-img-top"
            alt="{{ $organization->name }}"
            style="height: 210px; object-fit: cover;"
        >
    @else
        <div class="bg-light d-flex align-items-center justify-content-center"
             style="height: 210px;">
            <i class="bi bi-building text-secondary" style="font-size: 55px;"></i>
        </div>
    @endif

    <div class="card-body d-flex flex-column">

        @if($organization->category)
            <span class="badge bg-primary align-self-start mb-2">
                {{ $organization->category->name }}
            </span>
        @endif

        <h5 class="card-title fw-bold">
            {{ $organization->name }}
        </h5>

        <p class="text-muted small mb-2">
            <i class="bi bi-geo-alt"></i>
            {{ $organization->upazila?->name ?? '' }}
            {{ $organization->district?->name ?? '' }}
        </p>

        <p class="card-text text-muted">
            {{ Str::limit($organization->short_description, 120) }}
        </p>

        <a href="{{ route('organizations.show', $organization->slug) }}"
           class="btn btn-outline-primary mt-auto">
            বিস্তারিত দেখুন
        </a>

    </div>
</div>