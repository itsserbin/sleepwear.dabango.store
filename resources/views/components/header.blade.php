<div class="content">
    <div class="row">
        <div class="col header__logo logo">
            <a href="{{route('home')}}">
                <img src="{{asset('storage/img/content/logo.png')}}" alt="">
            </a>
        </div>
        <div class="col">
            <a href="{{route('checkout')}}" class="cart-count text-decoration-none text-dark">
                ({{$cartCount}})
                <b-icon icon="cart3" size="lg" variant="dark"></b-icon>
            </a>
        </div>
        <div class="header-burger col-1 p-0">
            <span></span>
        </div>
    </div>
</div>
