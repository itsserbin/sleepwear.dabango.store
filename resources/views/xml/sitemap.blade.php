<?= '<' . '?' . 'xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @if (!empty($categories))
        @foreach ($categories as $category_item)
            <url>
                <loc>{{route('category',$category_item->slug)}}</loc>
                <lastmod>{{$category_item->updated_at->toAtomString()}}</lastmod>
                <changefreq>daily</changefreq>
                <priority>1</priority>
            </url>
        @endforeach
    @endif
    @if (!empty($products))
        <items>
            @foreach ($products as $item)
                <url>
                    <loc>{{route('product',$item->id)}}</loc>
                    <lastmod>{{$item->updated_at->toAtomString()}}</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>1</priority>
                </url>
            @endforeach
        </items>
    @endif
</urlset>
