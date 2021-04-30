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
</ul>
