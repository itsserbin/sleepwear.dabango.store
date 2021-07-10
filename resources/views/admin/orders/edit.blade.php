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

            <order-edit user-name="{{\Illuminate\Support\Facades\Auth::user()->name}}"></order-edit>
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <form action="{{route('admin.orders.update', $order->id)}}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('PATCH')--}}
{{--                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::user()}}">--}}
{{--                    --}}{{-- Form include --}}
{{--                    @include('admin.orders.partials.form')--}}
{{--                    <button type="submit" class="btn btn-success">Сохранить</button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
