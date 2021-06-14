<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{asset('storage/img/content/logo.png')}}" width="75" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-between" id="navbarNavAltMarkup">
            <ul class="navbar-nav">

                @role('administrator','manager')
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : null }}"
                   href="{{route('admin.dashboard')}}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : null }}"
                   href="{{route('admin.products.index')}}">Товары</a>
                <a class="nav-link {{ request()->routeIs('admin.reviews.index') ? 'active' : null }}"
                   href="{{route('admin.reviews.index')}}">Отзывы</a>

                @if(Gate::allows('show-clients') OR Gate::allows('admin'))
                    <a class="nav-link {{ request()->routeIs('admin.clients.index') ? 'active' : null }}"
                       href="{{route('admin.clients.index')}}">Клиенты</a>
                @endif

                @if(Gate::allows('show-orders') OR Gate::allows('admin'))
                    <a class="nav-link {{ request()->routeIs('admin.orders.index') ? 'active' : null }}"
                       href="{{route('admin.orders.index')}}">Заказы</a>
                @endif
                @endrole

                @role('administrator')
                @if(Gate::allows('edit-options') OR Gate::allows('admin'))
                    <a class="nav-link {{ request()->routeIs('admin.options.index') ? 'active' : null }}"
                       href="{{route('admin.options.index')}}">Настройки</a>
                @endif

                @if(Gate::allows('show-bookkeeping') OR Gate::allows('admin'))
                    <a class="nav-link {{ request()->routeIs('admin.bookkeeping.index') ? 'active' : null }}"
                       href="{{route('admin.bookkeeping.index')}}">Бухгалтерия</a>
                @endif
                @endrole

            </ul>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-item">
                            <button class="btn" disabled>
                                <i>@foreach(auth()->user()->roles as $item){{$item->name}}@endforeach</i>
                            </button>
                        </li>
                        <li>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Выйти</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <a class="nav-link"
                   href="{{route('home')}}" target="_blank">
                    На сайт
                </a>
            </ul>
        </div>
    </div>
</nav>
