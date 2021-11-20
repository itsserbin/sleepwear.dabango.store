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
                    <description>{{$item->content}}</description>
                    <availability>
                        @if($item->status == 'Нет в наличии')
                            out of stock
                        @else
                            in stock
                        @endif
                    </availability>
                    <brand>Dabango</brand>
                    <condition>new</condition>
                    <price>{{$item->discount_price ?: $item->price}}</price>
                    <link>{{asset(route('product',$item->id))}}</link>
                    <image_link>{{asset($item->preview)}}</image_link>
                    <additional_image_link>
                        @foreach($item->ProductsPhoto as $item)
                            {{asset($item->image).',' }}
                        @endforeach
                    </additional_image_link>
                    <gender>female</gender>
                    <fb_product_category>Clothing and Accessories > Clothing > Women's Clothing</fb_product_category>
                    <google_product_category>Apparel and Accessories > Clothing</google_product_category>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
