<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            @if(isset($subsidiary))
                <a href="{{$active_link}}">{{$active}}</a>
            @else{{$active}}@endif
        </li>
        @if(isset($subsidiary))
            <li class="breadcrumb-item active" aria-current="page">
                {{$subsidiary}}
            </li>
        @endif
    </ol>
</nav>
