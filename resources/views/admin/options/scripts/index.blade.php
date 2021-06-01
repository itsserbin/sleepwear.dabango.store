@extends('layouts.app')
@section('title', 'Вставка CSS/JS')
@section('header', 'Вставка CSS/JS')

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
                            <label for="head_scripts" class="form-label">Head</label>
                            <textarea type="text" class="form-control" rows="10" id="head_scripts"
                                      name="head_scripts">{{$option->head_scripts ?? ""}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="after_body_scripts" class="form-label">Before body</label>
                            <textarea type="text" class="form-control" rows="10" id="after_body_scripts"
                                      name="after_body_scripts">{{$option->after_body_scripts ?? ""}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="footer_scripts" class="form-label">Footer</label>
                            <textarea type="text" class="form-control" rows="10" id="footer_scripts"
                                      name="footer_scripts">{{$option->footer_scripts ?? ""}}</textarea>
                        </div>

                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
