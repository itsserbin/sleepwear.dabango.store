<section id="shop" class="shop">
    <div class="content">
        <div class="shop__row">
            <div class="shop__col">
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

            <div class="shop__col">
                <div class="shop__product-name">
                    <div class="shop__title">{{$product->h1}}</div>
                    <div class="shop__product-availability">Товар в наличии</div>
                </div>


                <div class="shop__price">
                    @if(isset($product->discount_price))
                        <div class="shop__old-price">{{$product->price}}</div>
                        <div class="shop__actual-price">{{$product->discount_price}}</div>
                    @else
                        <div class="shop__price-without-discount">{{$product->price}}</div>
                    @endif
                    <button type="button" id="order"
                            class="shop__button order-button button button--color_red button--color-text_white">
                        <span class="icon-cart"></span>
                        <span>Купить</span>
                    </button>

                </div>

                <div class="shop__available-sizes available-sizes">
                    <div class="shop__available-sizes__label">Доступные размеры:</div>
                    @if(isset($product->s))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="s" class="mycheckbox__default"
                                       type="checkbox" disabled>
                                <span class="mycheckbox__new">S</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->m))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="m" class="mycheckbox__default"
                                       type="checkbox" disabled>
                                <span class="mycheckbox__new">M</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->l))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="l" class="mycheckbox__default"
                                       type="checkbox" disabled>
                                <span class="mycheckbox__new">L</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->xl))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="xl" class="mycheckbox__default"
                                       type="checkbox" disabled>
                                <span class="mycheckbox__new">XL</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->xxl))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="xxl" class="mycheckbox__default"
                                       type="checkbox" disabled>
                                <span class="mycheckbox__new">XXL</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif
                </div>
                <div class="available-colors">
                    <div class="available-colors__label">Доступные цвета:</div>
                    @foreach($ProductsColor as $item)
                        <style>
                            .mycheckbox.{{$item->Colors->name}}        {
                                background-color: {{$item->Colors->hex}};
                            }
                        </style>

                        <label class="mycheckbox {{$item->Colors->name}}">
                            <input name="colors[]" value="{{$item->Colors->name}}" class="mycheckbox__default"
                                   type="checkbox" disabled>
                            <span class="mycheckbox__new"></span>
                        </label>
                    @endforeach
                </div>


                <div class="shop__delivery-info" style="margin-top: 30px ">
                    <button id="sizes" class="shop__sizes-table">
                        <span class="icon-table"></span>
                        <span>Таблица размеров</span>
                    </button>
                </div>


                @if(isset($product->content))
                    <div class="shop__description-title block-title">Описание</div>
                    <div class="shop__description">
                        {!! $product->content !!}
                    </div>
                @endif
            </div>
            @if(isset($product->characteristics))
                <div class="shop__col">
                    <div id="specifications" class="shop__specifications-title block-title">Характеристики</div>
                    {!! $product->characteristics !!}
                </div>
            @endif
            <div class="shop__col">
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
                        <button id="review"
                                class="shop__button review-button button button--color_red button--color-text_white">
                            <span class="icon-file-text2"></span>
                            <span>Оставить отзыв</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
