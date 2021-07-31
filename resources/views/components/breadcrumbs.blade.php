<div class="content">
    <div class="row">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}">Dabango</a>
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
        <hr>
    </div>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Dabango",
        "item": "{{route('home')}}"
      },
      @if(isset($subsidiary))
      {
        "@type": "ListItem",
        "position": 2,
        "name": "{{$active}}",
        "item": "{{$active_link}}"
      },
      {
        "@type": "ListItem",
        "position": 3,
        "name": "{{$subsidiary}}"
      }
      @else
      {
        "@type": "ListItem",
        "position": 2,
        "name": "{{$active}}"
      }
      @endif
      ]
    }
    </script>
</div>
