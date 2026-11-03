@extends('layouts.app')

@section('title', 'Media Outlets of Munshiganj')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold">মুন্সিগঞ্জের গণমাধ্যম</h2>
        <p class="text-muted">মুন্সিগঞ্জ জেলার সংবাদপত্র, অনলাইন নিউজ পোর্টাল, টেলিভিশন ও অন্যান্য গণমাধ্যমের তথ্য।</p>
    </div>

    <form method="GET" action="{{ route('media-outlets.index') }}" class="card card-body mb-4">
        <div class="row g-3">

            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="গণমাধ্যমের নাম বা ঠিকানা লিখুন"
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">সকল ক্যাটাগরি</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="upazila_id" class="form-select">
                    <option value="">সকল উপজেলা</option>
                    @foreach(\App\Models\Upazila::orderBy('name')->get() as $upazila)
                        <option value="{{ $upazila->id }}" @selected(request('upazila_id') == $upazila->id)>
                            {{ $upazila->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> খুঁজুন
                </button>
            </div>

        </div>
    </form>

    <div class="row g-4">
        @forelse($mediaOutlets as $mediaOutlet)
            <div class="col-md-6 col-lg-4">
                <x-media-outlet-card :media-outlet="$mediaOutlet" />
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    কোনো গণমাধ্যমের তথ্য পাওয়া যায়নি।
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $mediaOutlets->links() }}
    </div>

</div>
@endsection