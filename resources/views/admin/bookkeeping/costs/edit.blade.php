@extends('layouts.app')

@section('title','Редактирование расхода')
@section('header','Редактирование расхода')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <form action="{{route('admin.bookkeeping.costs.update', $cost->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    @include('admin.bookkeeping.costs.partials.form')
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
