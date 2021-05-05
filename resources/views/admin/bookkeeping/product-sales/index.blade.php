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
                <div class="row mb-5">
                    <h2>Статистика по дням</h2>
                    <a href="{{route('admin.bookkeeping.product_sales.create')}}">
                        <button class="btn btn-light">
                            Посчитать день
                        </button>
                    </a>
                    <div class="table-responsive">
                        <table class="table text-center align-center">
                            <thead>
                            <tr style="vertical-align: middle;">
                                <th scope="col">Дата</th>
                                <th scope="col">Цена заявки</th>
                                <th scope="col">Затраты на рекламу</th>
                                <th scope="col">Кол-во заявок</th>
                                <th scope="col">В процессе</th>
                                <th scope="col">На почте</th>
                                <th scope="col">Выполненные</th>
                                <th scope="col">Возвраты</th>
                                <th scope="col">Отмененные</th>
                                <th scope="col">Не обработаны</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($days_orders as $item)
                                <tr style="vertical-align:middle;">
                                    <td scope="row">{{$item->date->format('d.m.y')}}</td>
                                    <td scope="row">{{number_format((float)$item->application_price, 2, ',', '')}}</td>
                                    <td scope="row">{{$item->advertising}}</td>
                                    <td scope="row">{{$item->applications}}</td>
                                    <td scope="row">{{$item->in_process}}</td>
                                    <td scope="row">{{$item->at_the_post_office}}</td>
                                    <td scope="row">{{$item->completed_applications}}</td>
                                    <td scope="row">{{$item->refunds}}</td>
                                    <td scope="row">{{$item->cancel}}</td>
                                    <td scope="row">{{$item->unprocessed}}</td>
                                    <td>
                                        <form
                                            onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                            action="{{route('admin.admin.bookkeeping.product_sales.destroy', $item)}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <button type="submit" class="btn">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                     class="bi bi-trash-fill"
                                                     fill="currentColor"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $done_orders->links() }}
                </div>

                <div class="row">
                    <h2>Статистика по товарам</h2>
                    <div class="table-responsive">
                        <table class="table text-center align-center">
                            <thead>
                            <tr style="vertical-align: middle;">
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Оптовая стоимость</th>
                                <th scope="col">Сумма продажи</th>
                                <th scope="col">Чистая прибыль</th>
                                <th scope="col">Дата создания заявки</th>
                                <th scope="col">Дата последнего обновления</th>
                                <th scope="col">Выплата от поставщика</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($done_orders as $item)
                                <tr style="vertical-align:middle;">
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->product->h1}}</td>
                                    <td scope="row">{{$item->trade_price}}</td>
                                    <td scope="row">{{$item->sale_price}}</td>
                                    <td scope="row">{{$item->profit}}</td>
                                    <td scope="row">{{$item->created_at->format('d.m.y')}}</td>
                                    <td scope="row">{{$item->updated_at->format('d.m.y')}}</td>
                                    <td scope="row">@if($item->pay)Получена@elseНе получена@endif</td>
                                    <td scope="row">
                                        <a class="btn btn-default"
                                           href="{{route('admin.orders.edit', $item->id)}}">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                 class="bi bi-pen"
                                                 fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                                                <path fill-rule="evenodd"
                                                      d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                                                <path
                                                    d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $done_orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
