<footer class="site-footer mt-5 pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h3 class="fw-bold">মুন্সিগঞ্জ আলো</h3>
                <p>
                    সমাজের ইতিবাচক পরিবর্তন, মানুষের সাফল্য,
                    মানবিক উদ্যোগ ও ভালো খবরের জন্য আমাদের আয়োজন।
                </p>
            </div>

            <div class="col-6 col-md-3">
                <h5 class="fw-bold">গুরুত্বপূর্ণ লিংক</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">হোম</a></li>
                    <li><a href="{{ route('news.index') }}">সর্বশেষ খবর</a></li>
                    <li><a href="{{ route('about') }}">আমাদের সম্পর্কে</a></li>
                    <li><a href="{{ route('contact') }}">যোগাযোগ</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-4">
                <h5 class="fw-bold">আমাদের লক্ষ্য</h5>
                <p>ভালো খবর তুলে ধরা, ইতিবাচক উদ্যোগকে উৎসাহ দেওয়া।</p>
            </div>
        </div>

        <hr class="border-light opacity-25">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
            <small>&copy; {{ date('Y') }} মুন্সিগঞ্জ আলো। সর্বস্বত্ব সংরক্ষিত।</small>
            <small>সত্য, ইতিবাচকতা ও মানবিকতার পক্ষে।</small>
        </div>
    </div>
</footer>