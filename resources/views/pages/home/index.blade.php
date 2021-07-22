@extends('layouts.master')
@section('title')Купить женские купальники в Украине недорого @endsection
@section('description')Женские купальники премиум качества с доставкой по всей Украине ✓ Лучшие коллекции 2021 года ✓ Доступные цены @endsection

@section('content')
    @include('components.modal-burger-menu')
    <section class="product-list card pt-3">
        <div class="container">
            <div class="product-list__title">Трендовые женские купальники 2021</div>
            <categories-grid></categories-grid>
            <product-cards></product-cards>
        </div>
    </section>
    @include('pages.product.components.advantages')
    @include('pages.product.components.shipping-and-payment')
    <section id="reviews" class="reviews">
        <div class="content">
            <div class="reviews__block-title block-title">Отзывы</div>
            <div class="reviews-slider">
                @if(count($reviews))
                    @foreach($reviews as $review)
                        @if($review->status)
                            <div class="reviews-slider__slide">
                                <div class="reviews-slider__name">{{$review->name}}</div>
                                <div class="reviews-slider__text">{{$review->comment}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else Комментарии отсутсвуют! @endif
            </div>
        </div>
    </section>

@endsection
