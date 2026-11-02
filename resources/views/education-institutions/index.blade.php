
@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'শিক্ষা প্রতিষ্ঠান')

@section('content')
<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">
            {{ isset($category) ? $category->name : 'শিক্ষা প্রতিষ্ঠান' }}
        </h1>
        <p class="text-muted">মুন্সিগঞ্জ জেলার শিক্ষা প্রতিষ্ঠানের তথ্যভান্ডার</p>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-6">
            <input name="search" class="form-control"
                   placeholder="প্রতিষ্ঠান বা EIIN খুঁজুন"
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
            <button class="btn btn-success w-100">খুঁজুন</button>
        </div>
    </form>

    <div class="mb-4">
        @foreach($categories as $item)
            <a href="{{ route('education-category.show', $item->slug) }}"
               class="btn btn-sm btn-outline-success mb-1">
                {{ $item->name }}
            </a>
        @endforeach
    </div>

    <div class="row g-4">
        @forelse($institutions as $institution)
            <div class="col-lg-4 col-md-6">
                <x-education-institution-card :institution="$institution" />
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5>কোনো শিক্ষা প্রতিষ্ঠান পাওয়া যায়নি।</h5>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $institutions->links() }}
    </div>
</div>
@endsection
