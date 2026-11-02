
@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'ঐতিহাসিক স্থানসমূহ')

@section('content')

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">
            {{ isset($category) ? $category->name : 'ঐতিহাসিক স্থানসমূহ' }}
        </h1>

        <p class="text-muted">
            মুন্সিগঞ্জের ঐতিহাসিক স্থান, ঐতিহ্য ও দর্শনীয় স্থানের তথ্য
        </p>
    </div>

    <form method="GET" action="{{ route('historical-places.index') }}"
          class="row g-2 mb-4">

        <div class="col-md-6">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="স্থান খুঁজুন..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">সকল ক্যাটাগরি</option>

                @foreach($categories as $item)
                    <option value="{{ $item->slug }}"
                        @selected(request('category') === $item->slug)>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-success w-100">
                খুঁজুন
            </button>
        </div>
    </form>

    <div class="mb-4">
        <a href="{{ route('historical-places.index') }}"
           class="btn btn-sm btn-outline-secondary">
            সকল স্থান
        </a>

        @foreach($categories as $item)
            <a href="{{ route('historical-place-category.show', $item->slug) }}"
               class="btn btn-sm btn-outline-success mb-1">
                {{ $item->name }}
            </a>
        @endforeach
    </div>

    <div class="row g-4">

        @forelse($places as $place)
            <div class="col-lg-4 col-md-6">
                <x-historical-place-card :place="$place" />
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5>কোনো ঐতিহাসিক স্থান পাওয়া যায়নি।</h5>
            </div>
        @endforelse

    </div>

    <div class="mt-4">
        {{ $places->links() }}
    </div>

</div>

@endsection
