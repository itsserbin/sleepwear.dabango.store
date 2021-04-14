@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{asset('css/pages/order.css')}}">
@endsection

@section('title', 'Заявка успешно отправлена!')

@section('content')
    <section class="order-page">
        <div class="content">
            <div class="row">
                <h1 class="order-page__title">Поздравляем! Ваш заказ принят!</h1>

                <div class="order-page__text">
                    <p>В ближайшее время с вами свяжется оператор для подтверждения заказа.</p>
                    <p>Пожалуйста, включите ваш контактный телефон ;)</p>
                </div>
                <a href="{{route('home')}}" class="order-page__button">
                    Вернуться на сайт
                </a>
            </div>
        </div>
    </section>
@endsection
