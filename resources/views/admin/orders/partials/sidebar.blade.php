<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.index') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.index')}}">Все заказы</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showNewOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showNewOrders')}}">Новые</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showProcessOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showProcessOrders')}}">В процессе</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showTransferredToSupplierOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showTransferredToSupplierOrders')}}">Передан поставщику</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showPostOfficeOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showPostOfficeOrders')}}">На почте</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showDoneOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showDoneOrders')}}">Выполненные</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showReturnOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showReturnOrders')}}">Возврат</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders.showCancelOrders') ? 'active' : null }}" aria-current="page"
           href="{{route('admin.orders.showCancelOrders')}}">Отмененные</a>
    </li>
</ul>
