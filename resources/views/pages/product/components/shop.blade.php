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
                        <img src="{{asset($product->preview)}}" alt="">
                    </div>
                    @foreach($productsPhoto as $photo)
                        <div class="shop-products-slider-big__image">
                            <img src="{{asset($photo->image)}}" alt="">
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
                    <div class="shop__old-price">{{$product->cost}}</div>
                    <div class="shop__actual-price">{{$product->sale_cost}}</div>
                    <button class="shop__button order-button button button--color_red button--color-text_white order">
                        Купить
                    </button>
                </div>
                <div class="shop__available-sizes available-sizes">
                    <div class="available-sizes__label">Доступные размеры:</div>
                    <div class="row">
                        <div class="available-sizes__element">S</div>
                        <div class="available-sizes__element">M</div>
                        <div class="available-sizes__element available-sizes__element--not-availale">L</div>
                        <div class="available-sizes__element available-sizes__element--not-availale">XL</div>
                        <div class="available-sizes__element available-sizes__element--not-availale">XXL</div>
                    </div>
                </div>
                <div class="shop__description-title block-title">Описание</div>
                <div class="shop__description">
                    {!! $product->content !!}
                </div>
            </div>
            <div class="column">
                <div id="specifications" class="shop__specifications-title block-title">Характеристики</div>
                {!! $product->characteristics !!}
            </div>
            <div class="column">
                <div id="reviews" class="reviews">
                    <div class="reviews__title block-title">Отзывы</div>
                    <div class="reviews-slider">
                        <div class="reviews-slider__slide">
                            <div class="reviews-slider__name">Александра</div>
                            <div class="reviews-slider__rating">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                            </div>
                            <div class="reviews-slider__text">Добрый день. Заказываю не первый раз. Ответ от продавца
                                мгновенный, отправка в кратчайшие сроки. А главное - товар качественный, размеры четкие!
                                Советую работать с данным продавцом.
                            </div>
                        </div>
                        <div class="reviews-slider__slide">
                            <div class="reviews-slider__name">Настя</div>
                            <div class="reviews-slider__rating">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                            </div>
                            <div class="reviews-slider__text">Дуже гарний магазин!! Рекомендую! Товар який я замовляла
                                мені не підійшов, обміняли відразу на потрібний. Дуже приємна дівчина продавець!
                            </div>
                        </div>
                        <div class="reviews-slider__slide">
                            <div class="reviews-slider__name">masha</div>
                            <div class="reviews-slider__rating">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                            </div>
                            <div class="reviews-slider__text">Заказала купальник. В целом покупкой довольна. Пошив -
                                качественный, менеджер - ответственный, доставка - быстрая. В дальнейшем буду заказывать
                                у данного продавца. Рекомендую!
                            </div>
                        </div>
                        <div class="reviews-slider__slide">
                            <div class="reviews-slider__name">Violetta</div>
                            <div class="reviews-slider__rating">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                                <img src="{{asset('storage/img/icon/star.png')}}" alt="">
                            </div>
                            <div class="reviews-slider__text">Менеджер дуже приємна дівчина. Уточнила всі нюанси
                                замовлення. Виконали дуже швидко і якісно. P.S РЕКОМЕНДУЮ. Внесли приємне різноманіття і
                                перчинку в наше життя.
                            </div>
                        </div>
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
