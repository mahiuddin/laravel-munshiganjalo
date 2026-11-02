<div class="news-card">
    <a href="{{ route('personalities.show', $personality->slug) }}"
       class="text-decoration-none">

        @if ($personality->photo)
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($personality->photo) }}"
                alt="{{ $personality->name }}"
                class="news-image">
        @else
            <div class="news-placeholder">
                <span>👤</span>
            </div>
        @endif
    </a>

    <div class="p-3">
        @if ($personality->category)
            <a href="{{ route('personality-category.show', $personality->category->slug) }}"
               class="category-pill">
                {{ $personality->category->name }}
            </a>
        @endif

        <h2 class="news-title mt-2 mb-2">
            <a href="{{ route('personalities.show', $personality->slug) }}">
                {{ $personality->name }}
            </a>
        </h2>

        @if ($personality->designation)
            <p class="text-secondary mb-2">
                {{ $personality->designation }}
            </p>
        @endif

        @if ($personality->short_bio)
            <p class="text-secondary mb-2">
                {{ \Illuminate\Support\Str::limit($personality->short_bio, 110) }}
            </p>
        @endif

        <div class="news-meta">
            @if ($personality->district)
                {{ $personality->district->name }}
            @endif

            @if ($personality->upazila)
                · {{ $personality->upazila->name }}
            @endif
        </div>

        <a href="{{ route('personalities.show', $personality->slug) }}"
           class="btn btn-sm btn-outline-success mt-3">
            বিস্তারিত পড়ুন
        </a>
    </div>
</div>
