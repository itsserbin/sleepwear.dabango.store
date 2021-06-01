@extends('layouts.app')
@section('title','Редактирование поставщика')
@section('header','Редактирование поставщика')

@section('content')
    <div class="container">
        @component('admin.components.breadcrumbs')
            @slot('active')Бухгалтерия@endslot
            @slot('active_link'){{route('admin.bookkeeping.index')}}@endslot
            @slot('subsidiary')Редактирование поставщика {{$provider->name}}@endslot
        @endcomponent

        <hr>

        <div class="row">
            <div class="col-12 col-md-2">
                @include('admin.bookkeeping.partials.sidebar')
            </div>

            <div class="col-12 col-md-10">
                <form action="{{route('admin.bookkeeping.providers.update',$provider->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('admin.bookkeeping.providers.partials.form')
                    <button class="btn btn-success my-3" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
