@extends('layouts.app')

@section('title','Редактирование пользователя')
@section('header','Редактирование пользователя')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.settings.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <form action="{{route('admin.users.update', $user->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- Form include --}}
                    @include('admin.settings.users.partials.form')

                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
