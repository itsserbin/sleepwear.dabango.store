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
        <hr>

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
                                <th scope="col">Контакты</th>
                                <th scope="col">Дата добавления</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($providers as $provider)
                                <tr style="vertical-align:middle;">
                                    <td scope="row">{{$provider->id}}</td>
                                    <td>{{$provider->name}}</td>
                                    <td>{{$provider->catalog ?? "Нет каталога"}}</td>
                                    <td>{{$provider->availability}}</td>
                                    <td>{{$provider->refunds}}</td>
                                    <td>{{$provider->prepayment}}</td>
                                    <td>{{$provider->time_of_dispatch}}</td>
                                    <td>{{$provider->comment}}</td>
                                    <td>{{$provider->contacts}}</td>
                                    <td>{{$provider->created_at}}</td>
                                    <td>
                                        <form
                                            onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                            action="{{route('admin.bookkeeping.providers.destroy', $provider)}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf

                                            <a class="btn btn-default"
                                               href="{{route('admin.bookkeeping.providers.edit', $provider)}}">
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
                                            <button type="submit" class="btn">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                     class="bi bi-trash-fill"
                                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                    {{ $providers->links() }}
                </div>

            </div>

        </div>
@endsection
