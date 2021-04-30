@extends('layouts.app')
@section('title','Редактирование отзыва')
@section('header','Редактирование отзыва')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.reviews.update', $review->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- Form include --}}
                    @include('admin.reviews.partials.form')
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
