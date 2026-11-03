<div class="card h-100 shadow-sm border-0">

    @if($mediaOutlet->featured_image)
        <img
            src="{{ asset('storage/' . $mediaOutlet->featured_image) }}"
            class="card-img-top"
            alt="{{ $mediaOutlet->name }}"
            style="height: 210px; object-fit: cover;"
        >
    @else
        <div class="bg-light d-flex align-items-center justify-content-center"
             style="height: 210px;">
            <i class="bi bi-newspaper text-secondary" style="font-size: 55px;"></i>
        </div>
    @endif

    <div class="card-body d-flex flex-column">

        @if($mediaOutlet->category)
            <span class="badge bg-primary align-self-start mb-2">
                {{ $mediaOutlet->category->name }}
            </span>
        @endif

        <h5 class="card-title fw-bold">
            {{ $mediaOutlet->name }}
        </h5>

        <p class="text-muted small mb-2">
            <i class="bi bi-geo-alt"></i>
            {{ $mediaOutlet->upazila?->name ?? '' }}
            {{ $mediaOutlet->district?->name ?? '' }}
        </p>

        @if($mediaOutlet->language)
            <p class="small mb-2">
                <strong>ভাষা:</strong> {{ $mediaOutlet->language }}
            </p>
        @endif

        <p class="card-text text-muted">
            {{ Str::limit($mediaOutlet->short_description, 120) }}
        </p>

        <a href="{{ route('media-outlets.show', $mediaOutlet->slug) }}"
           class="btn btn-outline-primary mt-auto">
            বিস্তারিত দেখুন
        </a>

    </div>
</div>