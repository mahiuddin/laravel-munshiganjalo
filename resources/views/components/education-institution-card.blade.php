
<div class="card h-100 border-0 shadow-sm">
    <a href="{{ route('education-institutions.show', $institution->slug) }}">
        @if($institution->featured_image)
            <img src="{{ asset('storage/' . $institution->featured_image) }}"
                 class="card-img-top"
                 style="height:210px; object-fit:cover;"
                 alt="{{ $institution->name }}">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center"
                 style="height:210px;">
                <span class="text-muted">No Image</span>
            </div>
        @endif
    </a>

    <div class="card-body">
        <span class="badge bg-success">
            {{ $institution->category?->name }}
        </span>

        <h5 class="mt-2">
            <a class="text-dark text-decoration-none"
               href="{{ route('education-institutions.show', $institution->slug) }}">
                {{ $institution->name }}
            </a>
        </h5>

        <p class="text-muted small">
            {{ $institution->district?->name }}
            @if($institution->upazila)
                , {{ $institution->upazila->name }}
            @endif
        </p>

        <p>{{ \Illuminate\Support\Str::limit($institution->short_description, 100) }}</p>

        <a href="{{ route('education-institutions.show', $institution->slug) }}"
           class="btn btn-outline-success btn-sm">
            বিস্তারিত
        </a>
    </div>
</div>
