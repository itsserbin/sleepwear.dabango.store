<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Клиенты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-center align-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Статус</th>
                                        <th scope="col">Имя</th>
                                        <th scope="col">Телефон</th>
                                        <th scope="col">Товар</th>
                                        <th scope="col">Размер</th>
                                        <th scope="col">Создан</th>
                                        <th scope="col">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($clients)
                                        @foreach($clients as $client)
                                            <tr style="vertical-align:middle;">
                                                <th scope="row">{{$client->id}}</th>
                                                <td>
                                                    @if($client->status == 'new')Новый@endif
                                                    @if($client->status == 'process')В процессе@endif
                                                    @if($client->status == 'done')Выполнен@endif
                                                    @if($client->status == 'cancel')Отменен@endif
                                                </td>
                                                <td>{{$client->name}}</td>
                                                <td>
                                                    <a href="tel:{{$client->phone}}">{{$client->phone}}</a></td>
{{--                                                <td><a href="{{route('product', $client->product)}}" target="_blank">{!! $client->product !!}</a>--}}
                                                <td>
                                                    <a href="{{route('product', $client->product)}}" target="_blank">{{$client->product}}</a>
                                                </td>
                                                <td>{{$client->size}}</td>
                                                <td>{{$client->created_at->format('d.m.Y h:m')}}</td>
                                                <td>
                                                    <form
                                                        onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                                        action="{{route('admin.clients.destroy', $client)}}"
                                                        method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        @csrf
                                                        <a class="btn btn-default"
                                                           href="{{route('admin.clients.edit', $client)}}">
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
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
