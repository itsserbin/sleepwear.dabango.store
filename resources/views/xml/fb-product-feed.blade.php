@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Dabango Products Feed</title>
        <description>Product Feed for Facebook</description>
        <link>{{asset('/')}}</link>
        <atom:link href="{{route('fb.product.feed')}}" rel="self" type="application/rss+xml"/>

        @if (!empty($products))
            @foreach ($products as $item)
                <item>
                    <id>{{ $item->id }}</id>
                    <title>{{ $item->h1 }}</title>
                    <description>{{$item->description}}</description>
                    <availability>
                        @if($item->status == 'Нет в наличии')
                            out of stock
                        @else
                            in stock
                        @endif
                    </availability>
                    <brand>Dabango</brand>
                    <condition>new</condition>
                    @if($item->discount_price !== null)
                        <price>{{$item->price}}</price>@endif
                    @if($item->discount_price)
                        <sale_price>{{$item->discount_price}}</sale_price>@endif
                    <link>{{asset(route('product',$item->id))}}</link>
                    <image_link>{{asset($item->preview)}}</image_link>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
