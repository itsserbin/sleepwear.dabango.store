<div class="row">
    <div class="col-12">
        @if(isset($ProductsColor))
            <h3>Актиные цвета</h3>
            @foreach($ProductsColor as $item)
                <input type="checkbox" class="btn-check" name="color[]" id="{{$item->color}}" autocomplete="off"
                       value="{{$item->color}}"
                       @if($item->color) checked @endif>
                <label class="btn btn-outline-primary my-1" for="{{$item->color}}">{!! $item->color !!}</label>
            @endforeach
        @endif
    </div>
</div>
<div class="row">
    <h3>Все цвета:</h3>
    <div class="col-12">
        <input type="checkbox" class="btn-check" name="color[]" id="black" autocomplete="off" value="Черный">
        <label class="btn btn-outline-primary my-1" for="black">Черный</label>

        <input type="checkbox" class="btn-check" name="color[]" id="white" autocomplete="off" value="Белый">
        <label class="btn btn-outline-primary my-1" for="white">Белый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="gray" autocomplete="off" value="Серый">
        <label class="btn btn-outline-primary my-1" for="gray">Серый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="red" autocomplete="off" value="Красный">
        <label class="btn btn-outline-primary my-1" for="red">Красный</label>

        <input type="checkbox" class="btn-check" name="color[]" id="pink" autocomplete="off" value="Розовый">
        <label class="btn btn-outline-primary my-1" for="pink">Розовый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="powdery" autocomplete="off"
               value="Пудровый">
        <label class="btn btn-outline-primary my-1" for="powdery">Пудровый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="burgundy" autocomplete="off"
               value="Бордовый">
        <label class="btn btn-outline-primary my-1" for="burgundy">Бордовый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="blue" autocomplete="off" value="Синий">
        <label class="btn btn-outline-primary my-1" for="blue">Синий</label>

        <input type="checkbox" class="btn-check" name="color[]" id="green" autocomplete="off" value="Зеленый">
        <label class="btn btn-outline-primary my-1" for="green">Зеленый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="turquoise" autocomplete="off"
               value="Бирюзовый">
        <label class="btn btn-outline-primary my-1" for="turquoise">Бирюзовый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="mint" autocomplete="off"
               value="Мятный">
        <label class="btn btn-outline-primary my-1" for="mint">Мятный</label>

        <input type="checkbox" class="btn-check" name="color[]" id="khaki" autocomplete="off" value="Хаки">
        <label class="btn btn-outline-primary my-1" for="khaki">Хаки</label>

        <input type="checkbox" class="btn-check" name="color[]" id="yellow" autocomplete="off" value="Желтый">
        <label class="btn btn-outline-primary my-1" for="yellow">Желтый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="citric" autocomplete="off" value="Лимонный">
        <label class="btn btn-outline-primary my-1" for="citric">Лимонный</label>

        <input type="checkbox" class="btn-check" name="color[]" id="beige" autocomplete="off" value="Бежевый">
        <label class="btn btn-outline-primary my-1" for="beige">Бежевый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="orange" autocomplete="off" value="Оранжевый">
        <label class="btn btn-outline-primary my-1" for="orange">Оранжевый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="purple" autocomplete="off" value="Фиолетовый">
        <label class="btn btn-outline-primary my-1" for="purple">Фиолетовый</label>

        <input type="checkbox" class="btn-check" name="color[]" id="crimson" autocomplete="off" value="Малиновый">
        <label class="btn btn-outline-primary my-1" for="crimson">Малиновый</label>
    </div>
</div>