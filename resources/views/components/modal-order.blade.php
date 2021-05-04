<div id="modal-order" class="modal">
    <div class="modal-content" id="order-modal">
        <button class="modal-close">
            <span class="icon-cross"></span>
        </button>
        <form action="{{route('send.form.post')}}" method="POST" class="form order-form">
            @csrf
            <div class="modal-par">
                <div class="shop__available-sizes available-sizes">
                    <div class="shop__available-sizes__label">Выберите размер:</div>
                    @if(isset($product->s))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="s" class="mycheckbox__default"
                                       type="checkbox">
                                <span class="mycheckbox__new">S</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->m))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="m" class="mycheckbox__default"
                                       type="checkbox">
                                <span class="mycheckbox__new">M</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->l))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="l" class="mycheckbox__default"
                                       type="checkbox">
                                <span class="mycheckbox__new">L</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->xl))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="xl" class="mycheckbox__default"
                                       type="checkbox">
                                <span class="mycheckbox__new">XL</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif

                    @if(isset($product->xxl))
                        <div class="size__element">
                            <label class="mycheckbox">
                                <input name="sizes[]" value="xxl" class="mycheckbox__default"
                                       type="checkbox">
                                <span class="mycheckbox__new">XXL</span>
                                <span class="mycheckbox__descr"></span>
                            </label>
                        </div>
                    @endif
                </div>

                <div class="available-colors">
                    <div class="available-colors__label">Выберите цвет:</div>
                    @foreach($ProductsColor as $item)
                        <style>
                            .mycheckbox.{{$item->Colors->name}}        {
                                background-color: {{$item->Colors->hex}};
                            }
                        </style>

                        <label class="mycheckbox {{$item->Colors->name}}">
                            <input name="colors[]" value="{{$item->Colors->name}}" class="mycheckbox__default"
                                   type="checkbox">
                            <span class="mycheckbox__new"></span>
                        </label>
                    @endforeach
                </div>
            </div>

            <label id="requestType-error" class="error" for="size"></label>
            <input name="name" placeholder="Ваше имя*" required>
            <input type="tel" name="phone" placeholder="Ваш номер телефона*" class="input-phone" required>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="product_name" value="{{$product->h1}}">
            <input type="hidden" name="sale_price" value="@if(isset($product->discount_price)){{$product->discount_price}}@else{{$product->price}}@endif">
            <input type="hidden" name="url" value="{{url()->current()}}">
            <button class="order-form__button order-button-modal button button--color_red button--color-text_white"
                    type="submit" id="submit">
                <span class="icon-arrow-right2"></span>
                <span>Заказать</span>
            </button>
        </form>
    </div>
</div>
