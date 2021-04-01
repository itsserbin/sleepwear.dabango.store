<div class="modal-fade modal-order">
    <div class="modal">
        <button class="modal-close">
            <span class="icon-cross"></span>
        </button>
        <form action="{{route('send.form')}}" method="POST" class="form order-form">
            @csrf
            <div class="order-form__size size">
                <div class="size__label">Выберите размер:</div>
                <div class="row">
                    <div class="size__element">
                        <input id="size-1" type="radio" name="size" value="s">
                        <label for="size-1">S</label>
                    </div>
                    <div class="size__element">
                        <input id="size-2" type="radio" name="size" value="m">
                        <label for="size-2">M</label>
                    </div>
                </div>
            </div>
            <input name="name" placeholder="Ваше имя*" required>
            <input type="tel" name="phone" placeholder="Ваш номер телефона*" class="input-phone" required>
            <button class="order-form__button order-button button button--color_red button--color-text_white" type="submit">Заказать</button>
        </form>
    </div>
</div>
