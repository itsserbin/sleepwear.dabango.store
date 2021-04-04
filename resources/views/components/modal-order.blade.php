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

                    @if(isset($product->s))
                    <div class="size__element">
                        <input id="size-1" type="radio" name="size" value="s" required>
                        <label for="size-1">S</label>
                    </div>
                    @endif

                    @if(isset($product->m))
                    <div class="size__element">
                        <input id="size-2" type="radio" name="size" value="m" required>
                        <label for="size-2">M</label>
                    </div>
                    @endif

                    @if(isset($product->l))
                    <div class="size__element">
                        <input id="size-3" type="radio" name="size" value="l" required>
                        <label for="size-3">L</label>
                    </div>
                    @endif

                    @if(isset($product->xl))
                    <div class="size__element">
                        <input id="size-4" type="radio" name="size" value="xl" required>
                        <label for="size-4">XL</label>
                    </div>
                    @endif

                    @if(isset($product->xxl))
                    <div class="size__element">
                        <input id="size-5" type="radio" name="size" value="xxl" required>
                        <label for="size-5">XXL</label>
                    </div>
                    @endif
                </div>
            </div>
<!--             <div class="order-form__color-selection color-selection">
                <div class="color-selection__label">Выберите цвет:</div>
                <div class="row">
                    <div class="color-selection__element color-selection__element--blue">
                        <input id="color-1" type="radio" name="color" value="blue" required>
                        <label for="color-1"></label>
                    </div>
                    <div class="color-selection__element color-selection__element--red">
                        <input id="color-2" type="radio" name="color" value="red" required>
                        <label for="color-2"></label>
                    </div>
                    <div class="color-selection__element color-selection__element--green">
                        <input id="color-3" type="radio" name="color" value="green" required>
                        <label for="color-3"></label>
                    </div>
                </div>
            </div> -->
            <input name="name" placeholder="Ваше имя*" required>
            <input type="tel" name="phone" placeholder="Ваш номер телефона*" class="input-phone" required>
            <input type="hidden" name="product" value="{{$product->id}}">
            <input type="hidden" name="status" value="new">
            <button class="order-form__button order-button button button--color_red button--color-text_white"
            type="submit">Заказать
        </button>
    </form>
</div>
</div>
