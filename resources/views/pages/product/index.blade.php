@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{asset('css/product/app.css')}}">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{$product->h1}}",
      "image": "{{$product->preview}}",
      "description": "{{$product->description}}",
      "sku": "{{$product->vendor_code}}",
      "mpn": "{{$product->id}}",
      "brand": {
        "@type": "Brand",
        "name": "Dabango"
      },

      "review": [
       @foreach($product->Reviews as $review_item)
      @if($loop->last)
      {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5"
      },

      "author": {
        "@type": "Person",
        "name": "{{$review_item->name}}"
      },
        "reviewBody": "{!! $review_item->comment !!}"
      }
      @else
      {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5"
      },

      "author": {
        "@type": "Person",
        "name": "{{$review_item->name}}"
      },
        "reviewBody": "{!! $review_item->comment !!}"
      },
      @endif
      @endforeach
      ],

      "offers": {
        "@type": "Offer",
        "url": "{{route('product',$product->id)}}",
        "priceCurrency": "UAH",
        "price": "{{$product->discount_price ? : $product->price}}",
        "priceValidUntil": "{{Carbon::now()->addYear()->format('c')}}",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "https://schema.org/InStock"
      },

      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5/5",
        "ratingCount": "{{$product->Reviews->count()}}"
      }
    }
    </script>
@endsection

@section('title'){{$product->title}}@endsection
@section('description'){{$product->description}}@endsection

@section('content')
    @component('components.breadcrumbs')
        @slot('active')
            @if(isset($product->categories[0]['title']))
                {{$product->categories[0]['title']}}
            @else
                Без категории
            @endif
        @endslot
        @slot('active_link')
            @if(isset($product->categories[0]['slug']))
                {{route('category',$product->categories[0]['slug']) ?? '#'}}
            @else
                #
            @endif
        @endslot
        @slot('subsidiary'){{$product->h1}}@endslot
    @endcomponent

    @include('pages.product.components.shop')
    @include('pages.product.components.relative')
    @include('pages.product.components.advantages')
    @include('pages.product.components.shipping-and-payment')
@endsection
