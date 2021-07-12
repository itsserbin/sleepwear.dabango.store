@extends('layouts.app')
@section('title','Детали заказа')
@section('header','Детали заказа')

@section('content')
    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('active')Заказы@endslot
            @slot('active_link'){{route('admin.orders.index')}}@endslot
            @slot('subsidiary')Детали заказа от {{$order->name}}@endslot
        @endcomponent
        <hr>
        <order-edit
            user-name="{{\Illuminate\Support\Facades\Auth::user()->name}}"
            colors-old="{!!  json_decode($order->colors)[0] ?? null !!}"
            sizes-old="{!!  json_decode($order->sizes)[0] ?? null  !!}">
        </order-edit>
    </div>
@endsection
