<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Room 911')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS usando AssetController -->
    <link href="{{ url('/assets/css/app.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ url('/assets/css/login.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ url('/assets/css/mobile.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ url('/assets/css/styles.css') }}?v={{ time() }}" rel="stylesheet">
</head>
<body>
    @include('layouts.partials.sidebar-left')
    @include('layouts.partials.navbar')
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap 5 Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript usando AssetController -->
    <script src="{{ url('/assets/js/app.js') }}?v={{ time() }}"></script>
    <script src="{{ url('/assets/js/allFunctions.js') }}?v={{ time() }}"></script>

    <!-- Script de verificación de assets -->
    <script src="{{ url('/assets/js/asset-checker.js') }}?v={{ time() }}"></script>
</body>
</html>
