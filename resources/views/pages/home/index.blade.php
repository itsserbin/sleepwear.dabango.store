@extends('layouts.master')
@section('title')Купить женские купальники в Украине недорого @endsection
@section('description')Женские купальники премиум качества с доставкой по всей Украине ✓ Лучшие коллекции 2021 года ✓ Доступные цены @endsection

@section('content')
    <section class="product-list card">
        <div class="content">
            <div class="product-list__title">Модные и стильные женские купальники 2021</div>
            <div class="row">
                @foreach($products as $product)
                    <a href="{{route('product', $product->id)}}" class="card__product">
                        <div class="card__image">
                            <img src="{{asset($product->preview)}}" alt="">
                        </div>
                        <h5 class="card__label">{{$product->h1}}</h5>
                        <div class="card__price">
                            @if(isset($product->sale_cost))
                                <div class="card__old-price">{{$product->cost}}</div>
                                <div class="card__actual-price">{{$product->sale_cost}}</div>
                            @else
                                <div class="card__price-without-discount">{{$product->cost}}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
