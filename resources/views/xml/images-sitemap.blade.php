<?= '<' . '?' . 'xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($products as $product)
        <url>
            <loc>{{route('product',$product->id)}}</loc>
            @foreach($product->ProductsPhoto as $item)
                <image:image>
                    <image:loc>{{asset($item->image)}}</image:loc>
                    <image:caption>{{$product->description}}</image:caption>
                    <image:title>{{$product->h1}}</image:title>
                </image:image>
            @endforeach
        </url>
    @endforeach
</urlset>
