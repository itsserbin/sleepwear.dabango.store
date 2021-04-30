<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.settings.index')}}">Основные</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.scripts') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.settings.scripts')}}">Скрипты</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.colors.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.settings.colors.index')}}">Цвета товара</a>
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
