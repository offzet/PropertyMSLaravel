<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Customer Dashboard' }} | PropertyPortal</title>

    <!-- Fonts & AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #111827;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">


    @include('layouts.customernav')

    {{-- Page Header --}}

    {{-- Page Content --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        © {{ date('Y') }} PropertyPortal. All rights reserved.
    </footer>

</body>
</html>
