@extends('layouts.app')
@section('title','Подсчитать прибыль за день')
@section('header','Подсчитать прибыль за день')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.bookkeeping.profit.store')}}" method="POST">
                    @csrf
                    @include('admin.bookkeeping.profit.partials.form')
                    <button class="btn btn-success my-3" type="submit">Сохранить</button>
                    <p>* Данные подсчитываються каждую минуту.</p>
                </form>
            </div>
        </div>
    </div>
@endsection
