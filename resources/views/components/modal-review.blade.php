<div class="modal-fade modal-review">
    <div class="modal">
        <button class="modal-close">
            <span class="icon-cross"></span>
        </button>
        <form action="{{route('send.review')}}" method="POST" class="form review-form">
            @csrf
            <input name="name" placeholder="Ваше имя*" required>
            <textarea name="comment" rows="6" minlength="8" maxlength="200" placeholder="Ваш отзыв" required></textarea>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <button type="submit" class="review-form__button review-button button button--color_red button--color-text_white">Оставить отзыв</button>
        </form>
    </div>
</div>
