
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'মুন্সিগঞ্জ আলো | ভালো খবরের আলো')</title>

    <meta name="description"
          content="@yield('meta_description', 'সমাজের ইতিবাচক খবর, সাফল্যের গল্প ও মানবিক উদ্যোগ নিয়ে মুন্সিগঞ্জ আলো।')">

    <meta name="theme-color" content="#087443">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        :root {
            --alo-green: #087443;
            --alo-dark: #075b36;
            --alo-light: #edf8f1;
            --alo-gold: #f5b82e;
            --alo-text: #25352c;
            --alo-muted: #6b7770;
        }

        body {
            font-family: 'Hind Siliguri', sans-serif;
            color: var(--alo-text);
            background: #f8faf8;
            line-height: 1.75;
        }

        a {
            color: var(--alo-green);
        }

        .brand-name {
            font-weight: 700;
            color: var(--alo-green);
            font-size: 1.8rem;
            line-height: 1.2;
        }

        .brand-tagline {
            font-size: .82rem;
            color: var(--alo-muted);
        }

        .navbar {
            background: #fff;
        }

        .navbar .nav-link {
            color: #27372e;
            font-weight: 600;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--alo-green);
        }

        .top-strip {
            background: var(--alo-dark);
            color: #fff;
            font-size: .9rem;
        }

        .section-title {
            font-weight: 700;
            border-left: 5px solid var(--alo-green);
            padding-left: 12px;
            margin-bottom: 1.25rem;
        }

        .btn-alo {
            background: var(--alo-green);
            color: #fff;
            border: 1px solid var(--alo-green);
        }

        .btn-alo:hover {
            background: var(--alo-dark);
            color: #fff;
        }

        .hero-panel {
            background: linear-gradient(125deg, #075b36, #13935b);
            color: #fff;
            border-radius: 18px;
            overflow: hidden;
        }

        .hero-panel a {
            color: inherit;
        }

        .news-card {
            height: 100%;
            background: #fff;
            border: 1px solid #e7eee9;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .07);
        }

        .news-image {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            background: var(--alo-light);
        }

        .news-placeholder {
            aspect-ratio: 16 / 9;
            background: linear-gradient(135deg, #e1f2e7, #f8f5dc);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--alo-green);
            font-size: 2.5rem;
        }

        .news-title {
            font-size: 1.12rem;
            line-height: 1.55;
            font-weight: 600;
        }

        .news-title a {
            color: var(--alo-text);
            text-decoration: none;
        }

        .news-title a:hover {
            color: var(--alo-green);
        }

        .news-meta {
            color: var(--alo-muted);
            font-size: .86rem;
        }

        .category-pill {
            display: inline-block;
            padding: .35rem .8rem;
            border-radius: 30px;
            background: var(--alo-light);
            text-decoration: none;
            margin: .2rem;
            font-weight: 500;
        }

        .content-panel {
            background: #fff;
            border: 1px solid #e7eee9;
            border-radius: 14px;
        }

        .article-content {
            font-size: 1.12rem;
            line-height: 2;
            overflow-wrap: anywhere;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
        }

        .site-footer {
            background: #103d2b;
            color: #e6f1e9;
        }

        .site-footer a {
            color: #e6f1e9;
            text-decoration: none;
        }

        .site-footer a:hover {
            color: var(--alo-gold);
        }

        .form-control:focus {
            border-color: var(--alo-green);
            box-shadow: 0 0 0 .2rem rgba(8, 116, 67, .12);
        }

        @media (max-width: 767px) {
            .brand-name {
                font-size: 1.5rem;
            }

            .hero-panel {
                border-radius: 12px;
            }

            .article-content {
                font-size: 1.04rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('partials.header')

    <main>
        @if (session('success'))
            <div class="container mt-3">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>