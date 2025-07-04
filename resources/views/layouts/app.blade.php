<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login</title>
    <link href="{{ mix('css/login.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.partials.sidebar-left')
    @include('layouts.partials.navbar')
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap 5 Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/allFunctions.js') }}"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</body>
</html>
