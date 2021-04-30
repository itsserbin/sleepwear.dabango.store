@extends('layouts.app')
@section('title','Все товары')
@section('header','Все товары')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                @if(Gate::allows('edit-products'))
                    <a href="{{route('admin.products.create')}}">
                        <button class="btn btn-light mb-4">
                            Добавить товар
                        </button>
                    </a>
                @elseif(Gate::allows('admin'))
                    <a href="{{route('admin.products.create')}}">
                        <button class="btn btn-light mb-4">
                            Добавить товар
                        </button>
                    </a>
                @endif

                <div class="table-responsive">
                    <table class="table text-center align-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Превью</th>
                            <th scope="col">Название</th>
                            <th scope="col">Артикул</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Дата добавления</th>
                            <th scope="col">Статус</th>
                            <th colspan="3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr style="vertical-align:middle;">
                                <th scope="row">{{$product->id}}</th>
                                <td><img class="mx-auto" style="width:75px;"
                                         src="{{asset($product->preview ?? "")}}" alt=""></td>
                                <td>
                                    {{$product->h1}}
                                </td>
                                <td>{{$product->vendor_code}}</td>
                                <td>@if(isset($product->discount_price)){{$product->discount_price}}@else{{$product->price}}@endif</td>
                                <td>{{$product->created_at->format('d.m.Y h:m')}}</td>
                                <td>
                                    @if($product->status)
                                        Опубликован
                                    @else
                                        Черновик
                                    @endif
                                </td>
                                <td>@if(Gate::allows('edit-products'))
                                        <form
                                            onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                            action="{{route('admin.products.destroy', $product)}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf

                                            <a class="btn btn-default"
                                               href="{{route('admin.products.edit', $product)}}">
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
                                    @elseif(Gate::allows('admin'))
                                        <form
                                            onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                            action="{{route('admin.products.destroy', $product)}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf

                                            <a class="btn btn-default"
                                               href="{{route('admin.products.edit', $product)}}">
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
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('product', $product->id)}}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-window"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                            <path
                                                d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
