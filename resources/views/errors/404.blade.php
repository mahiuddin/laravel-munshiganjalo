
@extends('layouts.app')

@section('title', 'পৃষ্ঠা পাওয়া যায়নি | মুন্সিগঞ্জ আলো')

@section('content')
<div class="container py-5">
    <div class="content-panel text-center p-5">
        <div class="display-1 fw-bold" style="color:var(--alo-green)">
            404
        </div>

        <h1 class="h3 fw-bold">দুঃখিত, পৃষ্ঠাটি পাওয়া যায়নি</h1>

        <p class="text-secondary">
            আপনি যে পৃষ্ঠাটি খুঁজছেন সেটি সরানো হয়েছে
            অথবা ঠিকানাটি ভুল হতে পারে।
        </p>

        <a href="{{ route('home') }}" class="btn btn-alo">
            হোমপেজে ফিরে যান
        </a>
    </div>
</div>
@endsection