<!-- resources/views/layouts/partials/navbar.blade.php -->  
<a class="navbar-brand" href="#">  
    <i class="fas fa-code"></i> <!-- Ícono de código -->  
    All Functions  
</a>  
<button class="btn btn-outline-secondary ms-auto sidebar-toggle-btn">  
    <i class="fas fa-chevron-left"></i>  
</button>  
<div class="collapse navbar-collapse" id="navbarSupportedContent">  
    <ul class="navbar-nav ml-auto">  
        <li class="nav-item dropdown">  
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                <i class="fas fa-user"></i> <!-- Ícono de usuario -->  
                
                @if(auth()->check()) <!-- Verificar si el usuario está autenticado -->  
                    <span class="username">{{ auth()->user()->first_name }}</span> <!-- Mostrar el nombre del usuario -->  
                @else  
                    <span>Invitado</span> <!-- Mostrar un texto alternativo si no hay usuario autenticado -->  
                @endif   
            </a>  
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">  
                <a class="dropdown-item" href="#">Configuración</a>  
                <a class="dropdown-item" href="#">Cambiar Clave</a>  
                <div class="dropdown-divider"></div>  
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">  
                    @csrf <!-- Asegúrate de incluir el token CSRF -->  
                    <button type="submit" class="dropdown-item text-danger" style="cursor: pointer;">Cerrar Sesión</button>  
                </form>  
            </div>  
        </li>  
    </ul>  
</div>