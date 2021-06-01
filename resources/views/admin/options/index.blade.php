@extends('layouts.app')
@section('title','Настройки')
@section('header','Настройки')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.options.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                @foreach($options as $option)
                    <form action="{{route('admin.options.update',1)}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="schedule" class="form-label">График работы</label>
                            <textarea type="text" class="form-control" id="schedule" name="schedule"
                                      placeholder="Введите телефон компании">{{$option->schedule ?? ""}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="phone" class="form-control" id="phone" name="phone"
                                   value="{{$option->phone ?? ""}}"
                                   placeholder="Введите телефон компании">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{$option->email ?? ""}}"
                                   placeholder="Введите e-mail компании">
                        </div>

                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" class="form-control" id="facebook" name="facebook"
                                   value="{{$option->facebook ?? ""}}"
                                   placeholder="Введите ссылку на facebook компании">
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" class="form-control" id="instagram" name="instagram"
                                   value="{{$option->instagram ?? ""}}"
                                   placeholder="Введите ссылку на instagram компании">
                        </div>

                        <div class="mb-3">
                            <label for="telegram" class="form-label">Telegram</label>
                            <input type="url" class="form-control" id="telegram" name="telegram"
                                   value="{{$option->telegram ?? ""}}"
                                   placeholder="Введите ссылку на telegram компании">
                        </div>

                        <div class="mb-3">
                            <label for="viber" class="form-label">Viber</label>
                            <input type="url" class="form-control" id="viber" name="viber"
                                   value="{{$option->viber ?? ""}}"
                                   placeholder="Введите ссылку на viber компании">
                        </div>

                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">Whatsapp</label>
                            <input type="url" class="form-control" id="whatsapp" name="whatsapp"
                                   value="{{$option->whatsapp ?? ""}}"
                                   placeholder="Введите ссылку на whatsapp компании">
                        </div>

                        <div class="mb-3">
                            <label for="fb_messenger" class="form-label">Facebook messenger</label>
                            <input type="url" class="form-control" id="fb_messenger" name="fb_messenger"
                                   value="{{$option->fb_messenger ?? ""}}"
                                   placeholder="Введите ссылку на facebook messenger компании">
                        </div>

                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
