@extends('layouts.app')
@section('title','Добавить нового поставщика')
@section('header','Добавить нового поставщика')

@section('content')
    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('active')Бухгалтерия@endslot
            @slot('active_link'){{route('admin.bookkeeping.index')}}@endslot
            @slot('subsidiary')Создание поставщика@endslot
        @endcomponent

        <hr>

        <div class="row">
            <div class="col-12 col-md-2">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-10">
                <form action="{{route('admin.bookkeeping.providers.store')}}" method="POST">
                    @csrf
                    @include('admin.bookkeeping.providers.partials.form')
                    <button class="btn btn-success my-3" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
