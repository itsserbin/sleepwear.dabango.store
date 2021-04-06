@extends('layouts.master')
@section('content')
<section class="product-list card">
    <div class="content">
        <div class="product-list__title">Список товаров</div>
        <div class="row">
            @foreach($products as $product)
            <a href="{{route('product', $product->id)}}" class="card__product">
                <div class="card__image">
                    <img src="{{asset($product->preview)}}" alt="">
                </div>
                <h5 class="card__label">{{$product->h1}}</h5>
                <div class="card__price">
                    <div class="card__old-price">{{$product->cost}}</div>
                    <div class="card__actual-price">{{$product->sale_cost}}</div>
                    <div class="card__price-without-discount">4000</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
