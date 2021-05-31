@extends('layouts.app')

@section('title','Редактирование прав')
@section('header','Редактирование прав')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.options.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <form action="{{route('admin.roles.update', $role->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- Form include --}}
                    @include('admin.options.roles.partials.form')

                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
