
<div class="top-strip py-1">
    <div class="container d-flex justify-content-between flex-wrap gap-1">
        <span>ভালোর সাথে আলোর পথে</span>
        <span>{{ now()->locale('bn')->translatedFormat('l, j F Y') }}</span>
    </div>
</div>

<nav class="navbar navbar-expand-lg shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand text-decoration-none" href="{{ route('home') }}">
            <span class="brand-name d-block">
                <img src="{{ asset('storage/munshiganj-alo-logo.png') }}"
                     alt="Munshiganj Alo"
                     class="news-image"
                     loading="lazy">
            </span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false"
                aria-label="মেনু খুলুন">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        হোম
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}"
                       href="{{ route('news.index') }}">
                        সর্বশেষ খবর
                    </a>
                </li> --}}

                {{-- Personality Menu --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('personalities.*', 'personality-category.*') ? 'active' : '' }}"
                       href="{{ route('personalities.index') }}">
                        ব্যক্তিত্ব
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('historical-places.*', 'historical-place-category.*') ? 'active' : '' }}"
                    href="{{ route('historical-places.index') }}">
                        ঐতিহাসিক স্থান
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('district-information.*') ? 'active' : '' }}"
                    href="{{ route('district-information.show') }}">
                        জেলা পরিচিতি
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('education-institutions.*', 'education-category.*') ? 'active' : '' }}"
                    href="{{ route('education-institutions.index') }}">
                        শিক্ষা প্রতিষ্ঠান
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('organizations.*', 'organization-category.*') ? 'active' : '' }}"
                    href="{{ route('organizations.index') }}">
                        সংগঠন
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('media-outlets.*', 'organization-category.*') ? 'active' : '' }}"
                    href="{{ route('media-outlets.index') }}">
                        মিডিয়া
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public-directories.*', 'organization-category.*') ? 'active' : '' }}"
                    href="{{ route('directories.index') }}">
                        ডিরেক্টরিস
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">
                        আমাদের সম্পর্কে
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">
                        যোগাযোগ
                    </a>
                </li>

            </ul>

            <form action="{{ route('search') }}" method="GET"
                  class="d-flex ms-lg-3 mt-3 mt-lg-0" role="search">

                <input class="form-control me-2"
                       type="search"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="খবর খুঁজুন"
                       aria-label="খবর খুঁজুন">

                <button class="btn btn-alo" type="submit">
                    খুঁজুন
                </button>
            </form>
        </div>
    </div>
</nav>
