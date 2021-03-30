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
                    <button class="shop__button button button--color_red button--color-text_white modal-open">Купить
                    </button>
                </div>
                <div class="shop__size-and-color">
                    <div class="shop__characteristic-label">Выберите размер:</div>
                    <div class="row">
                        <div class="shop__size">
                            <input id="size-1" type="radio" name="size" value="s" form="order-form">
                            <label for="size-1">S</label>
                        </div>
                        <div class="shop__size">
                            <input id="size-2" type="radio" name="size" value="m" form="order-form">
                            <label for="size-2">M</label>
                        </div>
                        <div class="shop__size">
                            <input id="size-3" type="radio" name="size" value="l" form="order-form">
                            <label for="size-3">L</label>
                        </div>
                        <div class="shop__size">
                            <input id="size-4" type="radio" name="size" value="xl" form="order-form">
                            <label for="size-4">XL</label>
                        </div>
                        <div class="shop__size">
                            <input id="size-5" type="radio" name="size" value="xxl" form="order-form">
                            <label for="size-5">XXL</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="shop__description-title block-title">Описание</div>
                <div class="shop__description">
                    {!! $product->content !!}
                </div>
            </div>
            <div class="column">
                <div class="shop__specifications-title block-title">Характеристики</div>
                {!! $product->characteristics !!}
            </div>
            <div class="column">
                <div class="reviews__block-title block-title">Отзывы</div>
                <div class="reviews-slider">
                    <div class="reviews-slider__slide">
                        <div class="reviews-slider__image">
                            <img src="img/content/face.jpg" alt="">
                        </div>
                        <div class="reviews-slider__name">Анатолий Анатолиевич</div>
                        <div class="reviews-slider__rating">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                        </div>
                        <div class="reviews-slider__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, debitis. Repudiandae, accusantium. Soluta explicabo itaque quia illum, rerum porro molestias saepe provident recusandae dolor laboriosam reiciendis quod, veniam ut, hic.</div>
                    </div>
                    <div class="reviews-slider__slide">
                        <div class="reviews-slider__image">
                            <img src="img/content/face.jpg" alt="">
                        </div>
                        <div class="reviews-slider__name">Анатолий Анатолиевич</div>
                        <div class="reviews-slider__rating">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                        </div>
                        <div class="reviews-slider__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ex vel labore dolor quo quisquam corrupti, ad perspiciatis quibusdam hic, nam tenetur quidem dolores consequatur, laudantium dicta temporibus omnis esse, repudiandae quas velit ipsa excepturi tempora! Veritatis, reiciendis animi ad pariatur quisquam laboriosam voluptatum, ipsa labore doloribus provident aspernatur, magni!</div>
                    </div>
                    <div class="reviews-slider__slide">
                        <div class="reviews-slider__image">
                            <img src="img/content/face.jpg" alt="">
                        </div>
                        <div class="reviews-slider__name">Анатолий Анатолиевич</div>
                        <div class="reviews-slider__rating">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                        </div>
                        <div class="reviews-slider__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, debitis. Repudiandae, accusantium. Soluta explicabo itaque quia illum, rerum porro molestias saepe provident recusandae dolor laboriosam reiciendis quod, veniam ut, hic.</div>
                    </div>
                    <div class="reviews-slider__slide">
                        <div class="reviews-slider__image">
                            <img src="img/content/face.jpg" alt="">
                        </div>
                        <div class="reviews-slider__name">Анатолий Анатолиевич</div>
                        <div class="reviews-slider__rating">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                            <img src="img/icon/star.png" alt="">
                        </div>
                        <div class="reviews-slider__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, debitis. Repudiandae, accusantium. Soluta explicabo itaque quia illum, rerum porro molestias saepe provident recusandae dolor laboriosam reiciendis quod, veniam ut, hic.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
