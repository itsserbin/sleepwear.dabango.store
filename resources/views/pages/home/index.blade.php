@extends('layouts.master')
@section('content')
    <section class="product-list">
        <div class="content">
            <div class="product-list__title block-title">Список товаров</div>
            <div class="row">
                @foreach($products as $product)
                    <a href="{{route('product', $product->id)}}" class="product-list__product">
                        <div class="product-list__image">
                            <img src="{{asset($product->preview)}}" alt="">
                        </div>
                        <h5 class="product-list__label">{{$product->h1}}</h5>
                        <div class="product-list__price">
                            <div class="product-list__old-price">{{$product->cost}}</div>
                            <div class="product-list__actual-price">{{$product->sale_cost}}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
