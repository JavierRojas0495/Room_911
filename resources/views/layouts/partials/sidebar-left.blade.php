<div class="sidebar">
    <div class="sidebar-header">
        All Modules
        <button class="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <ul class="modules-list">
        <!-- Opciones -->
        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#submenu1" aria-expanded="false" aria-controls="submenu1">
                <i class="fas fa-address-book	"></i> <span>Module Employee</span>
            </a>
            <ul class="submodules-list collapse" id="submenu1">
                <li><a href="{{ route('employee.create') }}">
                    <i class="fas fa-user-plus"></i> Create Employee
                </a></li>
                <li><a href="{{ route('employee.index') }}">
                    <i class="fas fa-list"></i> List Employee
                </a></li>
            </ul>
        </li>

        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#submenu2" aria-expanded="false" aria-controls="submenu2">
                <i class="fas fa-users"></i> <span>Module User Admin</span>
            </a>
            <ul class="submodules-list collapse" id="submenu2">
                <li> <a href="{{ route('user.create') }}">
                <i class="fas fa-user-plus"></i> Create User</a></li>
                <li><a href="{{ route('user.index') }}">
                <i class="fas fa-list"></i> List User</a></li>
            </ul>
        </li>

        <!-- Módulo de Usuarios -->
        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#usuariosSubMenu" aria-expanded="false" aria-controls="usuariosSubMenu">
                <i class="fas fa-users"></i> <span>Usuarios</span>
            </a>
            <ul class="submodules-list collapse" id="usuariosSubMenu">
                <li><a href="{{ route('user.create') }}">Registrar Usuario</a></li>
                <li><a href="Usuarios/listarUsuarios/listarUsuarios.html">Listar Usuarios</a></li>
            </ul>
        </li>

        <!-- Módulo de Registro de Productos -->
        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#productosSubMenu" aria-expanded="false" aria-controls="productosSubMenu">
                <i class="fas fa-box"></i> <span>Productos</span>
            </a>
            <ul class="submodules-list collapse" id="productosSubMenu">
                <li><a href="#">Registrar Producto</a></li>
                <li><a href="#">Listar Productos</a></li>
            </ul>
        </li>

        <!-- Módulo de Tienda Virtual -->
        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#tiendaSubMenu" aria-expanded="false" aria-controls="tiendaSubMenu">
                <i class="fas fa-store"></i> <span>Tienda Virtual</span>
            </a>
            <ul class="submodules-list collapse" id="tiendaSubMenu">
                <li><a href="#">Ver Catálogo</a></li>
                <li><a href="#">Carrito de Compras</a></li>
                <li><a href="#">Historial de Pedidos</a></li>
            </ul>
        </li>

        <!-- Módulo de Tareas -->
        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#tareasSubMenu" aria-expanded="false" aria-controls="tareasSubMenu">
                <i class="fas fa-tasks"></i> <span>Tareas</span>
            </a>
            <ul class="submodules-list collapse" id="tareasSubMenu">
                <li><a href="#">Crear Tarea</a></li>
                <li><a href="#">Lista de Tareas</a></li>
            </ul>
        </li>

        <!-- Módulo de SST -->
        <li class="module">
            <a href="#" class="module-toggle" data-toggle="collapse" data-target="#sstSubMenu" aria-expanded="false" aria-controls="sstSubMenu">
                <i class="fas fa-hard-hat"></i> <span>SST</span>
            </a>
            <ul class="submodules-list collapse" id="sstSubMenu">
                <li><a href="#">Reporte de Incidentes</a></li>
                <li><a href="#">Políticas de Seguridad</a></li>
            </ul>
        </li>
    </ul>
</div>
