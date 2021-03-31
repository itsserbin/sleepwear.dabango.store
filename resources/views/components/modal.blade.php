<div class="modal-fade">
    <div class="modal">
        <a class="modal-close" href="#">
            <span class="icon-cross"></span>
        </a>
        <form action="#" method="POST" id="order-form" class="order-form">
            <div class="order-form__size size">
                <div class="size__label">Выберите размер:</div>
                <div class="row">
                    <div class="size__element">
                        <input id="size-1" type="radio" name="size" value="s" required disabled>
                        <label for="size-1">S</label>
                    </div>
                    <div class="size__element">
                        <input id="size-2" type="radio" name="size" value="m" required disabled>
                        <label for="size-2">M</label>
                    </div>
                    <div class="size__element">
                        <input id="size-3" type="radio" name="size" value="l" required>
                        <label for="size-3">L</label>
                    </div>
                    <div class="size__element">
                        <input id="size-4" type="radio" name="size" value="xl" required disabled>
                        <label for="size-4">XL</label>
                    </div>
                    <div class="size__element">
                        <input id="size-5" type="radio" name="size" value="xxl" required>
                        <label for="size-5">XXL</label>
                    </div>
                </div>
            </div>
            <input name="name" placeholder="Ваше имя*" required>
            <input type="tel" name="phone" placeholder="Ваш номер телефона*" class="input-phone" required>
            <input type="email" name="email" placeholder="Ваш E-mail">
            <button class="order-form__button button button--color_red button--color-text_white">Заказать</button>
        </form>
    </div>
</div>
