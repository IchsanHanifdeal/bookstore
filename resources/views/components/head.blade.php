<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:url" content="https://syahbilfirdausbookstore.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="SYAHBIL FIRDAUS BERKARYA Bookstore">
    <meta property="og:description" content="Temukan berbagai macam buku dan sumber daya di SYAHBIL FIRDAUS BERKARYA Bookstore. Gerbang Anda menuju pengetahuan dan inspirasi.">
    <meta property="og:image" content="https://syahbilfirdausbookstore.com/assets/og-image.jpg">
    <meta property="og:image:width" content="470">
    <meta property="og:image:height" content="470">

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="syahbilfirdausbookstore.com">
    <meta property="twitter:url" content="https://syahbilfirdausbookstore.com">
    <meta name="twitter:title" content="SYAHBIL FIRDAUS BERKARYA Bookstore">
    <meta name="twitter:description" content="Jelajahi koleksi buku terbaik dan harta sastra di SYAHBIL FIRDAUS BERKARYA Bookstore.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <title>{{ $title ?? 'Beranda' }} | SYAHBIL FIRDAUS BERKARYA Bookstore</title>
    <meta name="description" content="Temukan buku terbaru, novel, dan banyak lagi di SYAHBIL FIRDAUS BERKARYA Bookstore. Tempat terbaik untuk literatur berkualitas.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
