<section class="relative product-list card">
    <div class="container">
        <div class="row">
            <div class="relative__title block-title">Смотрите также</div>
            <div class="relative-slider">
                @foreach($products as $product)
                    @if($product->status)
                        <a href="{{route('product', $product->id)}}" class="card__product text-decoration-none">
                            <div class="card__image">
                                <img src="{{asset($product->preview)}}" alt="{{$product->h1}}">
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
    </div>
</section>
