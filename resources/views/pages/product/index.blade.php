@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{asset('css/product/app.css')}}">
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
