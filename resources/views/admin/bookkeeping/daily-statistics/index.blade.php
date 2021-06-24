@extends('layouts.app')

@section('title','Статистика продаж')
@section('header','Статистика продаж')

@section('content')
    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('active')Бухгалтерия@endslot
            @slot('active_link'){{route('admin.bookkeeping.index')}}@endslot
            @slot('subsidiary')Статистика продаж@endslot
        @endcomponent
        <hr>

        <div class="row ">
            <div class="col-12 col-md-2">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-10">
                <bookkeeping-daily-statistics></bookkeeping-daily-statistics>
{{--                <div class="row mb-5">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12 col-md-6">--}}
{{--                            <h2>Статистика по дням</h2>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-md-6 text-end">--}}
{{--                            <a href="{{route('admin.bookkeeping.daily-statistics.create')}}">--}}
{{--                                <button class="btn btn-danger">--}}
{{--                                    Посчитать день--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-12 col-md-7">--}}
{{--                            <a href="{{route('admin.bookkeeping.daily-statistics.index')}}"--}}
{{--                               class="text-decoration-none">--}}
{{--                                <button class="btn btn-outline-warning my-3">--}}
{{--                                    За все время--}}
{{--                                </button>--}}
{{--                            </a>--}}

{{--                            <a href="{{route('admin.bookkeeping.daily-statistics.7Days')}}"--}}
{{--                               class="text-decoration-none">--}}
{{--                                <button class="btn btn-outline-warning my-3">--}}
{{--                                    За 7 дней--}}
{{--                                </button>--}}
{{--                            </a>--}}

{{--                            <a href="{{route('admin.bookkeeping.daily-statistics.week')}}" class="text-decoration-none">--}}
{{--                                <button class="btn btn-outline-warning my-3">--}}
{{--                                    За 14 дней--}}
{{--                                </button>--}}
{{--                            </a>--}}

{{--                            <a href="{{route('admin.bookkeeping.daily-statistics.30Days')}}"--}}
{{--                               class="text-decoration-none">--}}
{{--                                <button class="btn btn-outline-warning my-3">--}}
{{--                                    За 30 дней--}}
{{--                                </button>--}}
{{--                            </a>--}}

{{--                        </div>--}}
{{--                        <div class="col-12 col-md-5">--}}
{{--                            <form action="{{route('admin.bookkeeping.daily-statistics.dateRange')}}" method="POST"--}}
{{--                                  class="d-flex my-3">--}}
{{--                                @csrf--}}
{{--                                <input type="text"--}}
{{--                                       class="form-control datepicker-here"--}}
{{--                                       data-multiple-dates-separator=" - "--}}
{{--                                       id="date_range"--}}
{{--                                       name="date_range"--}}
{{--                                       placeholder="Выберите дату"--}}
{{--                                       data-range="true"--}}
{{--                                       data-date-format="yyyy-mm-dd">--}}
{{--                                <button type="submit" class="btn btn-outline-warning">--}}
{{--                                    Поиск--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    @if(!Route::is('admin.bookkeeping.daily-statistics.index'))--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Получено заявок:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($SumApplications)}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    На почте:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($SumAtThePostOffice)}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Средний COR:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($AverageCorRate, 2). '%'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Средний ROR:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($AverageRorRate, 2). '%'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Средний RPR:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($AverageRprRate, 2). '%'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Средняя цена заявки:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($AverageApplicationPrice, 2). ' грн.'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Средняя стоимость клиента:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($AverageClientCostRate, 2). ' грн.'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Общая прибыль:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($SumProfit, 2). ' грн.'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Затраты на рекламу:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($SumTargetCosts, 2). ' грн.'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Средняя маржа:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($AverageMarginality, 2). '%'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Прибыль инвестора:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($SumInvestorProfit, 2). ' грн.'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-6 col-md-3 text-center my-3">--}}
{{--                                <div class="h5">--}}
{{--                                    Зарплата менеджера:--}}
{{--                                </div>--}}
{{--                                <div class="h6">--}}
{{--                                    {{round($SumManagerSalary, 2). ' грн.'}}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                    @endif--}}
{{--                    @include('admin.bookkeeping.daily-statistics.partials.table')--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $("body").tooltip({selector: '[data-bs-toggle=tooltip]'});--}}
{{--        });--}}
{{--    </script>--}}
@endsection
