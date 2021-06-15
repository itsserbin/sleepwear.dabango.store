@extends('layouts.app')
@section('title', 'Заказы')
@section('header', 'Заказы')


@section('content')
    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('active')Заказы@endslot
        @endcomponent
        <hr>

        <div class="row">
            <div class="col-12 col-md-2">
                @include('admin.orders.partials.sidebar')
            </div>

            <div class="col-12 col-md-10">
                <orders-list></orders-list>
            </div>
        </div>
    </div>
@endsection
