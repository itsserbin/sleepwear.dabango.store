<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bookkeeping.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.bookkeeping.index')}}">Сводка</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bookkeeping.costs.index') ? 'active' : null }}"
           aria-current="page"
           href="{{route('admin.bookkeeping.costs.index')}}">Расходы</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bookkeeping.profit.index') ? 'active' : null }}"
           aria-current="page"
           href="{{route('admin.bookkeeping.profit.index')}}">Прибыль</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bookkeeping.daily-statistics.index') ? 'active' : null }}"
           aria-current="page"
           href="{{route('admin.bookkeeping.daily-statistics.index')}}">Статистика продаж по дням</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bookkeeping.product-statistics.index') ? 'active' : null }}"
           aria-current="page"
           href="{{route('admin.bookkeeping.product-statistics.index')}}">Статистика продаж товаров</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.bookkeeping.providers.index') ? 'active' : null }}"
           aria-current="page"
           href="{{route('admin.bookkeeping.providers.index')}}">Поставщики</a>
    </li>
</ul>
