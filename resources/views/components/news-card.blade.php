
@props(['news'])

<article class="news-card">
    <a href="{{ route('news.show', $news->slug) }}"
       class="text-decoration-none">
        @if ($news->featured_image)
            <img
                src="{{ asset('storage/' . $news->featured_image) }}"
                alt="{{ $news->title }}"
                class="news-image"
                loading="lazy">
        @else
            <div class="news-placeholder">
                <span aria-hidden="true">✦</span>
            </div>
        @endif
    </a>

    <div class="p-3">
        @if ($news->category)
            <a class="category-pill mb-2"
               href="{{ route('category.show', $news->category->slug) }}">
                {{ $news->category->name }}
            </a>
        @endif

        <h2 class="news-title mt-2 mb-2">
            <a href="{{ route('news.show', $news->slug) }}">
                {{ $news->title }}
            </a>
        </h2>

        @if ($news->excerpt)
            <p class="text-secondary mb-2">
                {{ \Illuminate\Support\Str::limit($news->excerpt, 125) }}
            </p>
        @endif

        <div class="news-meta">
            @if ($news->district)
                <span>{{ $news->district->name }}</span>
            @endif

            @if ($news->published_at)
                <span>
                    · {{ $news->published_at->locale('bn')->translatedFormat('j F Y') }}
                </span>
            @endif
        </div>
    </div>
</article>