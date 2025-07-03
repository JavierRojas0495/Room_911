<!-- resources/views/layouts/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info sticky-top shadow-sm px-3">
    <button class="btn btn-outline-light d-md-none me-2" id="sidebarOpenBtn" aria-label="Abrir menú">
        <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
        <i class="fas fa-code me-2"></i> <!-- Ícono de código -->
        All Functions
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> <!-- Ícono de usuario -->

                    @if(auth()->check()) <!-- Verificar si el usuario está autenticado -->
                        <span class="username">{{ auth()->user()->first_name }}</span> <!-- Mostrar el nombre del usuario -->
                    @else
                        <span>Invitado</span> <!-- Mostrar un texto alternativo si no hay usuario autenticado -->
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf <!-- Asegúrate de incluir el token CSRF -->
                            <button type="submit" class="dropdown-item text-danger" style="cursor: pointer; border: none; background: none; width: 100%; text-align: left; padding: 0.25rem 1rem;">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
