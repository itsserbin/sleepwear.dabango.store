<?= '<' . '?' . 'xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <shop>
        @if (!empty($categories))
            @foreach ($categories as $category_item)
                <catalog>
                    <category
                        id="{{$category_item->id}}"
                        @if($category_item->parent_id)parentId="{{$category_item->parent_id}}"@endif>
                        {{$category_item->title}}
                    </category>
                </catalog>
            @endforeach
        @endif
        @if (!empty($products))
            <items>
                @foreach ($products as $item)
                    <item id="{{$item->id}}" selling_type="r">
                        <name>{{$item->h1}}</name>
                        <priceuah>{{$item->discount_price ? : $item->price}}</priceuah>
                        <image>{{asset($item->preview)}}</image>
                        <vendor>Dabango</vendor>
                        <vendorCode>{{$item->vendor_code}}</vendorCode>
                        <description>{{$item->content}}</description>
                        <available>
                            @if($item->status == 'Нет в наличии')
                                false
                            @else
                                true
                            @endif
                        </available>
                        <keywords>{{$item->h1}}</keywords>
                    </item>
                @endforeach
            </items>
        @endif
    </shop>

</urlset>
