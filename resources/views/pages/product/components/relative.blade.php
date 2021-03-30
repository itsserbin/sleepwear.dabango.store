<section class="relative card">
    <div class="content">
        <div class="relative__title block-title">Смотрите также</div>
        <div class="relative-slider">
            @foreach($products as $product)
            <a href="{{route('product', $product->id)}}" class="card__product">
                <div class="card__image">
                    <img src="{{asset($product->preview)}}" alt="">
                </div>
                <h5 class="card__label">{{$product->h1}}</h5>
                <div class="card__price">
                    <div class="card__old-price">{{$product->cost}}</div>
                    <div class="card__actual-price">{{$product->sale_cost}}</div>
                </div>
                @endforeach
            </a>
        </div>
    </div>
</div>
</section>
