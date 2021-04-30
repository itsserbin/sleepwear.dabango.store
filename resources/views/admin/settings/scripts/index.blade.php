@extends('layouts.app')
@section('title', 'Вставка CSS/JS')
@section('header', 'Вставка CSS/JS')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.settings.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                @foreach($settings as $setting)
                    <form action="{{route('admin.settings.save')}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="head_scripts" class="form-label">Head</label>
                            <textarea type="text" class="form-control" rows="10" id="head_scripts"
                                      name="head_scripts">{{$setting->head_scripts ?? ""}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="after_body_scripts" class="form-label">Before body</label>
                            <textarea type="text" class="form-control" rows="10" id="after_body_scripts"
                                      name="after_body_scripts">{{$setting->after_body_scripts ?? ""}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="footer_scripts" class="form-label">Footer</label>
                            <textarea type="text" class="form-control" rows="10" id="footer_scripts"
                                      name="footer_scripts">{{$setting->footer_scripts ?? ""}}</textarea>
                        </div>

                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
