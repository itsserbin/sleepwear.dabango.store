<div id="modal-review" class="modal">
    <div class="modal-content" id="review-modal">
        <button class="modal-close">
            <span class="icon-cross"></span>
        </button>
        <form action="{{route('send.review.post')}}" method="POST" id="review-form" class="form review-form">
            <input name="name" placeholder="Ваше имя*" required>
            <textarea name="comment" rows="6" minlength="8" maxlength="200" placeholder="Ваш отзыв" required></textarea>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <button type="submit"
                    class="review-form__button review-button-modal button button--color_red button--color-text_white">
                <span class="icon-arrow-right2"></span>
                <span>Оставить отзыв</span>
            </button>
        </form>
    </div>
</div>
