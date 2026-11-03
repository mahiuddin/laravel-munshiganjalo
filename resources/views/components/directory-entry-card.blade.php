<div class="card h-100 shadow-sm border-0">

    @if($directoryEntry->featured_image)
        <img
            src="{{ asset('storage/' . $directoryEntry->featured_image) }}"
            class="card-img-top"
            alt="{{ $directoryEntry->name }}"
            style="height: 210px; object-fit: cover;"
        >
    @else
        <div class="bg-light d-flex align-items-center justify-content-center"
             style="height: 210px;">
            <i class="bi bi-geo-alt text-secondary" style="font-size: 55px;"></i>
        </div>
    @endif

    <div class="card-body d-flex flex-column">

        @if($directoryEntry->category)
            <span class="badge bg-primary align-self-start mb-2">
                {{ $directoryEntry->category->name }}
            </span>
        @endif

        <h5 class="card-title fw-bold">
            {{ $directoryEntry->name }}
        </h5>

        <p class="text-muted small mb-2">
            <i class="bi bi-geo-alt"></i>
            {{ $directoryEntry->upazila?->name ?? '' }}
            {{ $directoryEntry->district?->name ?? '' }}
        </p>

        @if($directoryEntry->phone)
            <p class="small mb-1">
                <i class="bi bi-telephone"></i>
                {{ $directoryEntry->phone }}
            </p>
        @endif

        @if($directoryEntry->emergency_phone)
            <p class="small mb-2">
                <i class="bi bi-telephone-plus"></i>
                {{ $directoryEntry->emergency_phone }}
            </p>
        @endif

        <p class="card-text text-muted">
            {{ Str::limit($directoryEntry->short_description, 120) }}
        </p>

        <a href="{{ route('directories.show', $directoryEntry->slug) }}"
           class="btn btn-outline-primary mt-auto">
            বিস্তারিত দেখুন
        </a>

    </div>
</div>