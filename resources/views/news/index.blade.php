
@extends('layouts.app')

@section('title', 'সর্বশেষ খবর | মুন্সিগঞ্জ আলো')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h1 class="section-title">সর্বশেষ ভালো খবর</h1>
        <p class="text-secondary">নতুন প্রকাশিত ইতিবাচক সংবাদ ও সাফল্যের গল্প।</p>
    </div>

    <div class="row g-4">
        @forelse ($news as $item)
            <div class="col-sm-6 col-lg-4">
                <x-news-card :news="$item" />
            </div>
        @empty
            <div class="col-12">
                <div class="content-panel p-5 text-center">
                    <h2 class="h5">কোনো সংবাদ পাওয়া যায়নি</h2>
                    <p class="text-secondary mb-0">
                        নতুন সংবাদ প্রকাশিত হলে এখানে দেখা যাবে।
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>
@endsection