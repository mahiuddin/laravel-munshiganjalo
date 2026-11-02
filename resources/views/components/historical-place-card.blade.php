
<div class="card h-100 border-0 shadow-sm">
    <a href="{{ route('historical-places.show', $place->slug) }}">
        @if($place->featured_image)
            <img
                src="{{ asset('storage/' . $place->featured_image) }}"
                class="card-img-top"
                alt="{{ $place->name }}"
                style="height: 220px; object-fit: cover;"
            >
        @else
            <div class="bg-light d-flex align-items-center justify-content-center"
                 style="height: 220px;">
                <span class="text-muted">No Image Available</span>
            </div>
        @endif
    </a>

    <div class="card-body">
        @if($place->category)
            <a href="{{ route('historical-place-category.show', $place->category->slug) }}"
               class="badge bg-success text-decoration-none mb-2">
                {{ $place->category->name }}
            </a>
        @endif

        <h5 class="card-title">
            <a href="{{ route('historical-places.show', $place->slug) }}"
               class="text-dark text-decoration-none">
                {{ $place->name }}
            </a>
        </h5>

        <p class="text-muted small mb-2">
            {{ $place->district?->name }}
            @if($place->upazila)
                , {{ $place->upazila->name }}
            @endif
        </p>

        <p class="card-text">
            {{ \Illuminate\Support\Str::limit($place->short_description, 120) }}
        </p>

        <a href="{{ route('historical-places.show', $place->slug) }}"
           class="btn btn-outline-success btn-sm">
            বিস্তারিত পড়ুন
        </a>
    </div>
</div>
