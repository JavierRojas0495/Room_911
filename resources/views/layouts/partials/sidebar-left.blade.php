<nav id="sidebar" class="sidebar bg-dark shadow-sm">
    <div class="sidebar-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
        <span class="fw-bold text-white">Módulos</span>
        <button id="sidebarCloseBtn" class="btn btn-outline-light btn-sm d-md-none" aria-label="Cerrar menú">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <ul class="modules-list nav flex-column mt-3">
        <li class="nav-item mb-2">
            <a class="sidebar-link d-flex align-items-center w-100" href="{{ route('empleado.crear') }}">
                <i class="fas fa-user-plus me-2"></i> Crear Empleado
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="sidebar-link d-flex align-items-center w-100" href="{{ route('empleado.indice') }}">
                <i class="fas fa-list me-2"></i> Listar Empleados
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="sidebar-link d-flex align-items-center w-100" href="{{ route('user.create') }}">
                <i class="fas fa-user-plus me-2"></i> Crear Admin
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="sidebar-link d-flex align-items-center w-100" href="{{ route('user.index') }}">
                <i class="fas fa-list me-2"></i> Listar Admin
            </a>
        </li>
    </ul>
</nav>
<!-- Overlay para móvil -->
<div id="sidebarOverlay" class="d-md-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="display:none; z-index:1040;"></div>
