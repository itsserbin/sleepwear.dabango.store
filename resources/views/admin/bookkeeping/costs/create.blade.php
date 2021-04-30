@extends('layouts.app')

@section('title','Добавить расход')
@section('header','Добавить расход')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('admin.bookkeeping.partials.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <form action="{{route('admin.bookkeeping.costs.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('admin.bookkeeping.costs.partials.form')

                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
