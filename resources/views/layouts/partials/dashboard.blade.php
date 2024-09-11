<!DOCTYPE html>
<html lang="es">
    @include('layouts.partials.head')

    <body>
        <!-- Barra Lateral -->
        <div class="sidebar">
            @include('layouts.partials.sidebar-left')
        </div>
    
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-hide">
            @include('layouts.partials.navbar')
        </nav>

        <!-- Contenido Principal -->
        <div class="" style="margin-top: 40px;">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('layouts.partials.footer') 
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/allFunctions.js') }}"></script>
    </body>
</html>
