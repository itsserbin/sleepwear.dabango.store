<section id="shop" class="shop">
    <div class="content">
        <div class="row">
            <div class="shop__first-side">
                <div class="shop-products-slider-small">
                    <div class="shop-products-slider-small__image">
                        <img src="{{asset($product->preview)}}" alt="">
                    </div>
                    @foreach($productsPhoto as $photo)
                        <div class="shop-products-slider-small__image">
                            <img src="{{asset($photo->image)}}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="shop-products-slider-big">
                    <div class="shop-products-slider-big__image">
                        <img data-lazy="{{asset($product->preview)}}" alt="">
                    </div>
                    @foreach($productsPhoto as $photo)
                        <div class="shop-products-slider-big__image">
                            <img data-lazy="{{asset($photo->image)}}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="column">
                <div class="shop__product-name">
                    <div class="shop__title">{{$product->h1}}</div>
                    <div class="shop__product-availability">Товар в наличии</div>
                </div>
                <div class="shop__price">
                    @if(isset($product->sale_cost))
                        <div class="shop__old-price">{{$product->cost}}</div>
                        <div class="shop__actual-price">{{$product->sale_cost}}</div>
                    @else
                        <div class="shop__price-without-discount">{{$product->cost}}</div>
                    @endif
                    <button class="shop__button order-button button button--color_red button--color-text_white order">
                        Купить
                    </button>
                </div>
                <div class="shop__available-sizes available-sizes">
                    <div class="available-sizes__label">Доступные размеры:</div>
                    <div class="row">
                        <div
                            class="available-sizes__element @if($product->s == null) available-sizes__element--not-availale @endif">
                            S
                        </div>
                        <div
                            class="available-sizes__element @if($product->m == null) available-sizes__element--not-availale @endif">
                            M
                        </div>
                        <div
                            class="available-sizes__element @if($product->l == null) available-sizes__element--not-availale @endif">
                            L
                        </div>
                        <div
                            class="available-sizes__element @if($product->xl == null) available-sizes__element--not-availale @endif">
                            XL
                        </div>
                        <div
                            class="available-sizes__element @if($product->xxl == null) available-sizes__element--not-availale @endif">
                            XXL
                        </div>
                    </div>
                </div>

                @if(count($ProductsColor))
                <div class="shop__available-colors available-colors">
                    <div class="available-colors__label"><b>Доступные цвета:</b></div>
                    <div class="row">
                        @foreach($ProductsColor as $item)
                            <div class="available-colors__element">{{$item->color}}</div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(isset($product->content))
                    <div class="shop__description-title block-title">Описание</div>
                    <div class="shop__description">
                        {!! $product->content !!}
                    </div>
                @endif
            </div>
            @if(isset($product->characteristics))
                <div class="column">
                    <div id="specifications" class="shop__specifications-title block-title">Характеристики</div>
                    {!! $product->characteristics !!}
                </div>
            @endif
            <div class="column">
                <div id="reviews" class="reviews">
                    <div class="reviews__title block-title">Отзывы</div>
                    <div class="reviews-slider">
                        @if(count($product->reviews))
                            @foreach($product->reviews as $review)
                                @if($review->status)
                                    <div class="reviews-slider__slide">
                                        <div class="reviews-slider__name">{{$review->name}}</div>
                                        <div class="reviews-slider__text">{{$review->comment}}</div>
                                    </div>
                                @endif
                            @endforeach
                        @else Отзывы отсутсвуют! @endif
                    </div>
                    <div class="button-wrapper">
                        <button
                            class="shop__button review-button button button--color_red button--color-text_white review">
                            Оставить отзыв
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
