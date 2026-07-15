<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nook & Peony</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white min-h-screen">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>


    <script src="{{ asset('js/ajax.js') }}"></script>
</body>
</html>