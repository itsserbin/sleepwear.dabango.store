<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.options.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.options.index')}}">Основные</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.options.scripts') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.options.scripts')}}">Скрипты</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.options.colors.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.options.colors.index')}}">Цвета товара</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.users.index')}}">Пользователи</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.roles.index')}}">Роли</a>
    </li>
</ul>
