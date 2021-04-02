<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="{{asset('storage/img/content/logo.png')}}" width="75" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : null }}"
                           href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : null }}"
                           href="{{route('admin.products.index')}}">Товары</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.clients.index') ? 'active' : null }}"
                           href="{{route('admin.clients.index')}}">Клиенты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reviews.index') ? 'active' : null }}"
                           href="{{route('admin.reviews.index')}}">Отзывы</a>
                    </li>
                </ul>
                <ul class="ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">{{ Auth::user()->email }}</a>
                        </div>
                    </li>
                </ul>
            </div>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="button" class="btn btn-success">
                    <a href="{{route('home')}}" target="_blank" style="text-decoration: none; color: white;">Открыть сайт</a>
                </button>
                <button type="submit" class="btn btn-danger">Выйти</button>
            </form>
        </nav>
    </div>
</div>
