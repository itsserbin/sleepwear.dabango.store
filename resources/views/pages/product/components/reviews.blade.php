<section id="reviews" class="reviews">
    <div class="content">
        <div class="reviews__block-title block-title">Отзывы</div>
        <div class="reviews-slider">
            @if(count($product->reviews))
                @foreach($product->reviews as $review)
                    @if($review->status = 1)
                    <div class="reviews-slider__slide">
                        <div class="reviews-slider__name">{{$review->name}}</div>
                        <div class="reviews-slider__text">{{$review->comment}}
                        </div>
                    </div>
                    @endif
                @endforeach
            @else Комментарии отсутсвуют! @endif
        </div>
    </div>
</section>
