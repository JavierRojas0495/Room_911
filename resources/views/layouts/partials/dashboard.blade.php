<!DOCTYPE html>
<html lang="es">
    @include('layouts.partials.head')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <body>
        <!-- Barra Lateral y Navbar -->
        @include('layouts.partials.navbar')
        @include('layouts.partials.sidebar-left')
        <!-- Contenido Principal -->
        <main class="main-content" style="min-height: 100vh; padding-top: 70px;">
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>
        <!-- Footer -->
        @include('layouts.partials.footer')
        <!-- Bootstrap 5 Bundle (incluye Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/allFunctions.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('button[data-employee-id][title="Historial"]').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    var empleadoId = btn.getAttribute('data-employee-id');
                    var modalId = 'historyModal-' + empleadoId;
                    var modalEl = document.getElementById(modalId);
                    if (modalEl) {
                        var modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            });
        });
        </script>
    </body>
</html>
