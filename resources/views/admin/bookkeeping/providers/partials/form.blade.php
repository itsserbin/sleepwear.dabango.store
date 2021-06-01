<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите название поставщика"
                   value="{{$provider->name ?? ""}}" required>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="refunds">Возвраты</label>
            <input type="text" class="form-control" id="refunds" name="refunds"
                   placeholder="Введите сумму оплаты за возврат"
                   value="{{$provider->refunds ?? ""}}" required>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="prepayment">Предоплата</label>
            <select class="form-control" id="prepayment" name="prepayment">
                @if (isset($provider->id))
                    <option value="0" @if ($provider->prepayment == 0) selected="" @endif>Нет</option>
                    <option value="1" @if ($provider->prepayment == 1) selected="" @endif>Есть</option>
                @else
                    <option value="0">Нет</option>
                    <option value="1">Есть</option>
                @endif
            </select>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="catalog">Каталог</label>
            <input type="text" class="form-control" id="catalog" name="catalog" placeholder="Введите ссылку на каталог"
                   value="{{$provider->catalog ?? ""}}" required>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="availability">Наличие</label>
            <input type="text" class="form-control" id="availability" name="availability"
                   placeholder="Введите ссылку на наличие"
                   value="{{$provider->name ?? ""}}" required>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="time_of_dispatch">Время отправки</label>
            <input type="text" class="form-control" id="time_of_dispatch" name="time_of_dispatch"
                   placeholder="Укажите до какого времени отправка"
                   value="{{$provider->time_of_dispatch ?? ""}}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="comment">Комментарии</label>
            <textarea type="text" class="form-control" id="comment" name="comment" rows="6"
                      placeholder="Комментарии..." required>{{$provider->comment ?? ""}}</textarea>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="contacts">Контакты</label>
            <textarea type="text" class="form-control" id="contacts" name="contacts" rows="6"
                      placeholder="Укажите контактные данные поставщика"
                      required>{{$provider->contacts ?? ""}}</textarea>
        </div>
    </div>
</div>
