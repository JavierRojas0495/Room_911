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
                <i class="fas fa-users"></i> <span>Module Users Admin</span>
            </a>
            <ul class="submodules-list collapse" id="submenu2">
                <li> <a href="{{ route('user.create') }}">
                <i class="fas fa-user-plus"></i> Create Admin</a></li>
                <li><a href="{{ route('user.index') }}">
                <i class="fas fa-list"></i> List Admin</a></li>
            </ul>
        </li>
    </ul>
</div>
