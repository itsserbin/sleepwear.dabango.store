@extends('layouts.master')

@section('title','Ваша корзина')

@section('content')
    <section class="cart">
        <div class="container">
            <cart-list></cart-list>
        </div>
    </section>
@endsection
