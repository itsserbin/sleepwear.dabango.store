@extends('layouts.app')

@section('title', 'Все номера телефонов')
@section('header', 'Все номера телефонов')

@section('content')
    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('active')Все номера телефонов@endslot
        @endcomponent
        <hr>

        <div class="row">
            <div class="col-12 col-md-2">
                @include('admin.orders.partials.sidebar')
            </div>

            <div class="col-12 col-md-10">
                @foreach($phones as $phone)
                    {{preg_replace('/[^0-9]/', '', $phone->phone)}}
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection

