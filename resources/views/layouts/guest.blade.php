<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Recipe App') }}</title>
    @vite(['resources/css/app.css'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Page Content -->
    <main class="min-h-screen flex items-center justify-center">
        {{ $slot }}
    </main>

    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>