<li class="nav-item">
    <a class='sidebar-link' href="{{ route('admin.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-dashboard"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>

@can('users.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('users.index') }}">
        <span class="icon-holder">
            <i class="c-red-500 ti-user"></i>
        </span>
        <span class="title">Usuarios</span>
    </a>
</li>
@endcan

@can('roles.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('roles.index') }}">
        <span class="icon-holder">
            <i class="c-yellow-800 ti-panel"></i>
        </span>
        <span class="title">Roles</span>
    </a>
</li>
@endcan

@can('projects.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('projects.index') }}">
        <span class="icon-holder">
            <i class="c-green-800 ti-home"></i>
        </span>
        <span class="title">Proyectos</span>
    </a>
</li>
@endcan

@can('materials.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('materials.index') }}">
        <span class="icon-holder">
            <i class="c-purple-800 ti-brush-alt"></i>
        </span>
        <span class="title">Materiales</span>
    </a>
</li>
@endcan

@can('projects.update')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('projects.assign') }}">
        <span class="icon-holder">
            <i class="c-blue-800 ti-shopping-cart"></i>
        </span>
        <span class="title">Asignación</span>
    </a>
</li>
@endcan