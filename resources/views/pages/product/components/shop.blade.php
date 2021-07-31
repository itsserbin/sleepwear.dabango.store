<section id="shop" class="shop">
    <div class="content">
        <div class="shop__row">
            <div class="shop__col">
                <div class="shop-products-slider-small">
                    <div class="shop-products-slider-small__image">
                        <img src="{{asset($product->preview)}}" alt="{{$product->h1}} {{$product->id}} - превью">
                    </div>
                    @foreach($productsPhoto as $photo)
                        <div class="shop-products-slider-small__image">
                            <img src="{{asset($photo->image)}}" alt="{{$product->h1}} {{$photo->id}} - превью">
                        </div>
                    @endforeach
                </div>
                <div class="shop-products-slider-big">
                    <div class="shop-products-slider-big__image">
                        <img data-lazy="{{asset($product->preview)}}" alt="{{$product->h1}} {{$product->id}}">
                    </div>
                    @foreach($productsPhoto as $photo)
                        <div class="shop-products-slider-big__image">
                            <img data-lazy="{{asset($photo->image)}}" alt="{{$product->h1}} {{$photo->id}}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="shop__col">
                <div class="shop__product-name">
                    <div class="shop__title">{{$product->h1}}</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="shop__product-code text-end">Код: {{$product->vendor_code}}/{{$product->id}}</div>
                        <div class="shop__product-availability">Товар в наличии</div>
                    </div>
                </div>


                <div class="shop__price d-flex align-items-center">
                    @if(isset($product->discount_price))
                        <div class="shop__old-price">{{$product->price}}</div>
                        <div class="shop__actual-price">{{$product->discount_price}}</div>
                    @else
                        <div class="shop__price-without-discount">{{$product->price}}</div>
                    @endif
                    <add-to-cart></add-to-cart>
                </div>

                <sizes-table size-table="{{$product->size_table ?? 'null'}}"></sizes-table>

                <available-size
                    xs="{{$product->xs ?? 'null'}}"
                    s="{{$product->s ?? 'null'}}"
                    m="{{$product->m ?? 'null'}}"
                    l="{{$product->l ?? 'null'}}"
                    xl="{{$product->xl ?? 'null'}}"
                    xxl="{{$product->xxl ?? 'null'}}"
                    xxxl="{{$product->xxxl ?? 'null'}}"
                ></available-size>

                <available-colors id="{{$product->id}}"></available-colors>

                <div class="mt-5">
                    @if(isset($product->content))
                        <div class="shop__description-title block-title">Описание</div>
                        <div class="shop__description">
                            {!! $product->content !!}
                        </div>
                    @endif
                </div>
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
                    <review-form id="{{$product->id}}"></review-form>
                </div>
            </div>
        </div>
    </div>
</section>
