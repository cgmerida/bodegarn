<li class="nav-item">
    <a class='sidebar-link' href="{{ route('admin.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>

{{-- @can('users.index') --}}
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('users.index') }}">
        <span class="icon-holder">
            <i class="c-red-500 ti-user"></i>
        </span>
        <span class="title">Usuarios</span>
    </a>
</li>
{{-- @endcan --}}
