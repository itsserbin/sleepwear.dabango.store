@extends('layouts.app')

@section('title', 'Редактирование цветов товара')
@section('header', 'Редактирование цветов товара')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.settings.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <div class="table-responsive">
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addColorModal">
                        Добавить цвет
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
                        <form action="{{route('admin.settings.colors.store')}}" method="POST">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addColorModalLabel">Добавить цвет</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Название</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Введите название цвета">
                                        </div>
                                        <div class="mb-3">
                                            <label for="hex" class="form-label">HEX</label>
                                            <input type="text" class="form-control" id="hex" name="hex"
                                                   placeholder="Введите hex код">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена
                                        </button>
                                        <button type="submit" class="btn btn-success">Добавить цвет</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <table class="table text-center align-center">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Hex</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors as $color)
                            <tr style="vertical-align:middle;">
                                <th scope="row">{{$color->name}}</th>
                                <td>{{$color->hex}}</td>
                                <td>
                                    <form
                                        onsubmit="if(confirm('Удалить?')){ return true }else{ return false }"
                                        action="{{route('admin.settings.colors.destroy', $color)}}"
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
            </div>
        </div>
@endsection
