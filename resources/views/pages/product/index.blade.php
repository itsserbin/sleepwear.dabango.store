@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{asset('css/product/app.css')}}">
@endsection

@section('content')
    @include('components.modal')
    @include('pages.product.components.shop')
    @include('pages.product.components.advantages')
    @include('pages.product.components.shipping-and-payment')
    @include('pages.product.components.relative')
    {{--    @include('product.components.reviews')--}}
@endsection
