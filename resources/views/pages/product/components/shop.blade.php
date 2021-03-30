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
                    <div class="shop__colors">
                        <div class="shop__characteristic-label">Выберите цвет:</div>
                        <div class="row">
                            <div class="shop__color shop__color--blue">
                                <input id="color-1" type="radio" name="color" value="blue" form="order-form">
                                <label for="color-1"></label>
                            </div>
                            <div class="shop__color shop__color--red">
                                <input id="color-2" type="radio" name="color" value="red" form="order-form">
                                <label for="color-2"></label>
                            </div>
                            <div class="shop__color shop__color--green">
                                <input id="color-3" type="radio" name="color" value="green" form="order-form">
                                <label for="color-3"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="shop__description-title block-title">Описание</div>
                <div class="shop__description">
                    {!! $product->content !!}
                </div>
                <div class="shop__specifications-title block-title">Характеристики</div>
                {!! $product->characteristics !!}
                <div class="button-wrapper">
                    <button class="shop__button button button--color_red button--color-text_white modal-open">Купить
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
