
@extends('layouts.app')

@section('title', 'খবর অনুসন্ধান | মুন্সিগঞ্জ আলো')

@section('content')
<div class="container py-5">
    <h1 class="section-title">খবর খুঁজুন</h1>

    <form action="{{ route('search') }}" method="GET" class="mb-4">
        <div class="input-group input-group-lg">
            <input type="search" name="q" value="{{ $search }}"
                   class="form-control"
                   placeholder="খবরের শিরোনাম বা বিষয় লিখুন..."
                   aria-label="খবর অনুসন্ধান">
            <button class="btn btn-alo" type="submit">অনুসন্ধান</button>
        </div>
    </form>

    @if ($search !== '')
        <p class="text-secondary">
            “{{ $search }}” অনুসন্ধানের ফলাফল: {{ $news->total() }}টি
        </p>
    @endif

    <div class="row g-4">
        @forelse ($news as $item)
            <div class="col-sm-6 col-lg-4">
                <x-news-card :news="$item" />
            </div>
        @empty
            <div class="col-12">
                <div class="content-panel p-4">
                    কোনো সংবাদ পাওয়া যায়নি। অন্য শব্দ দিয়ে খুঁজে দেখুন।
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $news->links() }}</div>
</div>
@endsection