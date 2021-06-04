@extends('layouts.app')

@section('title','Прибыль')
@section('header','Прибыль')

@section('content')
    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('active')Бухгалтерия@endslot
            @slot('active_link'){{route('admin.bookkeeping.index')}}@endslot
            @slot('subsidiary')Прибыль@endslot
        @endcomponent
        <hr>

        <div class="row">
            <div class="col-12 col-md-2">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2>Прибыль с вычетом расходов</h2>
                    </div>

                    <div class="col-12 col-md-6 text-end">
                        <a href="{{route('admin.bookkeeping.profit.create')}}">
                            <button class="btn btn-danger">
                                Добавить дату
                            </button>
                        </a>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="table-responsive">
                        <table class="table text-center align-center">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Дата по которой посчитана статистика">
                                        <b>Дата</b>
                                    </button>
                                </th>
                                <th scope="col">
                                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Сумма всех расходов">
                                        <b>Расходы</b>
                                    </button>
                                </th>
                                <th scope="col">
                                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Общая маржинальность проданных товаров, без вычета расходов">
                                        <b>Прибыль</b>
                                    </button>
                                </th>
                                <th scope="col">
                                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Формула: Маржа проданных товаров - Сумма всех затрат">
                                        <b>Маржа</b>
                                    </button>
                                </th>
                                <th scope="col">
                                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Формула: Маржа проданных товаров + Сумма всех затрат">
                                        <b>Оборот</b>
                                    </button>
                                </th>
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
        <script>
            $(document).ready(function () {
                $("body").tooltip({selector: '[data-bs-toggle=tooltip]'});
            });
        </script>
@endsection
