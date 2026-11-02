@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' | মুন্সিগঞ্জ আলো' : 'মুন্সিগঞ্জের বিশিষ্ট ব্যক্তিত্ব | মুন্সিগঞ্জ আলো')

@section('meta_description', 'মুন্সিগঞ্জ জেলার বিশিষ্ট ব্যক্তিত্ব, তাঁদের জীবন, কর্ম ও অবদান সম্পর্কে জানুন।')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h1 class="section-title">
            @isset($category)
                {{ $category->name }}
            @else
                মুন্সিগঞ্জের বিশিষ্ট ব্যক্তিত্ব
            @endisset
        </h1>

        <p class="text-secondary">
            মুন্সিগঞ্জের কৃতী মানুষ, তাঁদের জীবন, কর্ম ও অবদানের গল্প।
        </p>
    </div>

    {{-- Search --}}
    <div class="content-panel p-3 mb-4">
        <form action="{{ route('personalities.index') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-10">
                    <input
                        type="search"
                        name="q"
                        class="form-control"
                        placeholder="ব্যক্তির নাম বা পরিচয় দিয়ে খুঁজুন..."
                        value="{{ $search ?? '' }}">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-alo w-100">
                        খুঁজুন
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Categories --}}
    @if ($categories->isNotEmpty())
        <div class="mb-4">
            <h2 class="h5 fw-bold mb-2">বিভাগ অনুযায়ী দেখুন</h2>

            <div>
                @foreach ($categories as $item)
                    <a
                        href="{{ route('personality-category.show', $item->slug) }}"
                        class="category-pill {{ isset($category) && $category->id === $item->id ? 'text-white' : '' }}"
                        @if(isset($category) && $category->id === $item->id)
                            style="background: var(--alo-green);"
                        @endif
                    >
                        {{ $item->name }}
                    </a>
                @endforeach

                @isset($category)
                    <a href="{{ route('personalities.index') }}"
                       class="category-pill">
                        সব ব্যক্তিত্ব
                    </a>
                @endisset
            </div>
        </div>
    @endif

    {{-- Personality Cards --}}
    <div class="row g-4">
        @forelse ($personalities as $personality)
            <div class="col-sm-6 col-lg-4">
                <x-personality-card :personality="$personality" />
            </div>
        @empty
            <div class="col-12">
                <div class="content-panel p-5 text-center">
                    <h2 class="h5">কোনো ব্যক্তিত্ব পাওয়া যায়নি</h2>
                    <p class="text-secondary mb-0">
                        @if (!empty($search))
                            আপনার অনুসন্ধানের সঙ্গে মিলে এমন কোনো ব্যক্তিত্ব পাওয়া যায়নি।
                        @else
                            নতুন ব্যক্তিত্ব প্রকাশিত হলে এখানে দেখা যাবে।
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $personalities->links() }}
    </div>

</div>
@endsection
