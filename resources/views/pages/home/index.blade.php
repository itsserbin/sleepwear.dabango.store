@extends('layouts.master')
@section('title')Купить женские купальники в Украине недорого @endsection
@section('description')Женские купальники премиум качества с доставкой по всей Украине ✓ Лучшие коллекции 2021 года ✓ Доступные цены @endsection

@section('content')
    @include('components.modal-burger-menu')
    <section class="product-list card">
        <div class="content">
            <div class="product-list__title">Модные и стильные женские купальники 2021</div>
            <div class="row">
                @foreach($products as $product)
                    @if($product->status)
                        <a href="{{route('product', $product->id)}}" class="card__product">
                            <div class="card__image">
                                <img src="{{asset($product->preview)}}" alt="">
                            </div>
                            <div class="card__body">
                                <h5 class="card__label">{{$product->h1}}</h5>
                                <div class="card__price">
                                    @if(isset($product->discount_price))
                                        <div class="card__old-price">{{$product->price}}</div>
                                        <div class="card__actual-price">{{$product->discount_price}}</div>
                                    @else
                                        <div class="card__price-without-discount">{{$product->price}}</div>
                                    @endif
                                </div>
                                <span class="card__button">Подробнее</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
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
