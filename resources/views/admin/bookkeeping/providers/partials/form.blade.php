@extends('layouts.app')

@section('title','Поставщики')
@section('header','Поставщики')

@section('content')
    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('active')Бухгалтерия@endslot
            @slot('active_link'){{route('admin.bookkeeping.index')}}@endslot
            @slot('subsidiary')Поставщики@endslot
        @endcomponent

        <div class="row">
            <div class="col-12 col-md-2">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-10">
                <a href="{{route('admin.bookkeeping.providers.create')}}">
                    <button class="btn btn-light">
                        Добавить поставщика
                    </button>
                </a>
                <div class="row mb-5">
                    <div class="table-responsive">
                        <table class="table text-center align-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Каталог</th>
                                <th scope="col">Наличие</th>
                                <th scope="col">Возвраты</th>
                                <th scope="col">Предоплата</th>
                                <th scope="col">До какого времени отправка</th>
                                <th scope="col">Комментарии</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profits as $profit)
                                <tr style="vertical-align:middle;">
                                    <td scope="row">{{$profit->date->format('d.m.Y')}}</td>
                                    <td>@convert($profit->cost) ₴</td>
                                    <td>@convert($profit->profit) ₴</td>
                                    <td>@convert($profit->marginality) ₴</td>
                                    <td>@convert($profit->turnover) ₴</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tr>
                                <th scope="row" colspan="4" class="text-end">Чистая маржа а 3 дня:</th>
                                <td colspan="2" class="text-center">@convert($ProfitInJustAThreeDays) ₴</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="4" class="text-end">Чистая маржа за 7 дней:</th>
                                <td colspan="2" class="text-center">@convert($ProfitInJustAWeek) ₴</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="4" class="text-end">Чистая маржа за этот месяц:</th>
                                <td colspan="2" class="text-center">@convert($ProfitInJustAMonth) ₴</td>
                            </tr>
                        </table>
                    </div>
                    {{ $profits->links() }}
                </div>

            </div>

        </div>
@endsection
