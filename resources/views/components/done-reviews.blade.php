@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{asset('css/pages/order.css')}}">
@endsection

@section('title', 'Заявка успешно отправлена!')

@section('content')
    <section class="order-page">
        <div class="content">
            <div class="row">
                <h1 class="order-page__title">Ваш отзыв успешно отправлен на модерацию!</h1>

                <div class="order-page__text">
                    <p>После проверки Вашего отзыва модератором на наличие спама - он будет опубликовать в ближайшее время ;)</p>
                </div>
                <a href="{{route('home')}}" class="order-page__button">
                    Вернуться на сайт
                </a>
            </div>
        </div>
    </section>
@endsection
