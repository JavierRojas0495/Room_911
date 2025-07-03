<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ mix('css/login.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.partials.sidebar-left')
    @include('layouts.partials.navbar')
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap 5 Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar responsive toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtn = document.getElementById('sidebarOpenBtn');
            const closeBtn = document.getElementById('sidebarCloseBtn');

            if (openBtn && sidebar) {
                openBtn.addEventListener('click', function() {
                    sidebar.classList.add('show');
                    if (overlay) overlay.style.display = 'block';
                });
            }

            if (closeBtn && sidebar && overlay) {
                closeBtn.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.style.display = 'none';
                });
            }

            if (overlay && sidebar) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.style.display = 'none';
                });
            }

            // Cierra el sidebar al hacer click en un enlace (solo móvil)
            if (sidebar) {
                const navLinks = sidebar.querySelectorAll('a.nav-link');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 768) {
                            sidebar.classList.remove('show');
                            if (overlay) overlay.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</body>
</html>
