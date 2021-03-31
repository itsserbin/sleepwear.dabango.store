<div class="modal-fade modal-review">
    <div class="modal">
        <button class="modal-close">
            <span class="icon-cross"></span>
        </button>
        <form action="#" method="POST" class="form review-form">
            <input name="name" placeholder="Ваше имя*" required>
            <textarea name="review" rows="6" minlength="8" maxlength="200" placeholder="Ваш отзыв" required></textarea>
            <div class="order-form__rating rating">
                <div class="rating__label">Ваша оценка:</div>
                <div class="row">
                    <div class="rating__element">
                        <input id="review-1" type="radio" name="size" value="1" required>
                        <label for="review-1">1</label>
                    </div>
                    <div class="rating__element">
                        <input id="review-2" type="radio" name="size" value="2" required>
                        <label for="review-2">2</label>
                    </div>
                    <div class="rating__element">
                        <input id="review-3" type="radio" name="size" value="3" required>
                        <label for="review-3">3</label>
                    </div>
                    <div class="rating__element">
                        <input id="review-4" type="radio" name="size" value="4" required>
                        <label for="review-4">4</label>
                    </div>
                    <div class="rating__element">
                        <input id="review-5" type="radio" name="size" value="5" required>
                        <label for="review-5">5</label>
                    </div>
                </div>
            </div>
            <button class="review-form__button review-button button button--color_red button--color-text_white">Оставить отзыв</button>
        </form>
    </div>
</div>
