@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<listings>
    <title>Dabango Products Feed</title>
    @if (!empty($products))
        @foreach ($products as $item)
            <listing>
                <id>{{ $item->id }}</id>
                <title>{{ $item->h1 }}</title>
                <description>{{$item->description}}</description>
                <availability>{{$item->status}}</availability>
                <condition>new</condition>
                @if($item->discount_price !== null)
                    <price>{{$item->price}}</price>@endif
                @if($item->discount_price)
                    <sale_price>{{$item->discount_price}}</sale_price>@endif
                <link>{{asset(route('product',$item->id))}}</link>
                <image_link>{{asset($item->preview)}}</image_link>
            </listing>
        @endforeach
    @endif
</listings>
