<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" id="status" name="status">
        <option value="Новый" @if ($order->status == 'Новый') selected="" @endif>Новый</option>
        <option value="В процессе" @if ($order->status == 'В процессе') selected="" @endif>В процессе</option>
        <option value="Передан поставщику" @if ($order->status == 'Передан поставщику') selected="" @endif>Передан
            поставщику
        </option>
        <option value="На почте" @if ($order->status == 'На почте') selected="" @endif>На почте</option>
        <option value="Отменен" @if ($order->status == 'Отменен') selected="" @endif>Отменен</option>
        <option value="Возврат" @if ($order->status == 'Возврат') selected="" @endif>Возврат</option>
        <option value="Выполнен" @if ($order->status == 'Выполнен') selected="" @endif>Выполнен</option>
    </select>
</div>

<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{$order->name}}">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="phone">Номер телефона</label>
            <input type="text" class="form-control" id="phone" name="phone"
                   value="{{$order->phone}}">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="vendor_code">Арткул</label>
            <input type="text" class="form-control" id="vendor_code" name="vendor_code"
                   value="{{$order->Product->vendor_code}}" disabled>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="sale_price">Цена закупки</label>
            <input type="text" class="form-control" id="sale_price" name="sale_price"
                   value="{{$order->trade_price}}" disabled>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="sale_price">Цена продажи</label>
            <input type="text" class="form-control" id="sale_price" name="sale_price"
                   value="{{$order->sale_price}}" disabled>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="sale_price">Маржинальность</label>
            <input type="text" class="form-control" id="sale_price" name="sale_price"
                   value="{{$order->sale_price - $order->trade_price}}" disabled>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="product_name">Название товара</label>
            <a href="{{route('product', $order->product_id)}}" target="_blank">
                <input type="text" class="form-control" id="product_name" name="product_name"
                       value="{{$order->Product->h1}}" disabled>
            </a>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="product_id">ID товара</label>
            <a href="{{route('product', $order->product_id)}}" target="_blank">
                <input type="text" class="form-control" id="product_id" name="product_id"
                       value="{{$order->product_id}}" disabled>
            </a>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="product_sizes">Размер(ы)</label>
            <input type="text" class="form-control" id="product_sizes" name="product_sizes"
                   value="@if(isset($order->sizes)) @foreach($order->sizes as $size){{$size}} @endforeach @else Размер не выбран @endif">
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="product_colors">Цвет(а)</label>
            <input type="text" class="form-control" id="product_colors" name="product_colors"
                   value="@if(isset($order->colors)) @foreach($order->colors as $color){{$color}} @endforeach @else Цвет не выбран @endif">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="city">Город</label>
            <input type="text" class="form-control" id="city" name="city"
                   value="{{$order->city ?? ""}}">
        </div>


        <div class="form-group my-3">
            <label for="postal_office">Номер почтового отеделения</label>
            <input type="text" class="form-control" id="postal_office" name="postal_office"
                   value="{{$order->postal_office ?? ""}}">
        </div>

        <div class="form-group my-3">
            <label for="waybill">Номер накладной</label>
            <input type="text" class="form-control" id="waybill" name="waybill"
                   value="{{$order->waybill ?? ""}}">
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="comment">Комментарий</label>
            <textarea rows="8" class="form-control" id="comment" name="comment">{{$order->comment ?? ""}}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="pay">Выплата от поставщика: {{$order->sale_price - $order->trade_price}} грн.</label>
            <select class="form-control" id="pay" name="pay">
                <option value="0" @if ($order->pay) selected="" @endif>Не получена</option>
                <option value="1" @if ($order->pay) selected="" @endif>Получена</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="created_at">Дата обновления</label>
            <input type="text" class="form-control datepicker-here" id="created_at" data-timepicker="true"
                   data-time-format='hh:mm' name="created_at"
                   value="{{$order->updated_at}}" disabled>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="created_at">Дата создания</label>
            <input type="text" class="form-control datepicker-here" id="created_at" data-timepicker="true"
                   data-time-format='hh:mm' name="created_at"
                   value="{{$order->created_at}}" disabled>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group my-3">
            <label for="modified_by">Обновлено пользователем</label>
            <input type="hidden" name="modified_by" value="{{auth()->user()->name}}">
            <input type="text" class="form-control"
                   placeholder="{{$order->modified_by ?? '-'}}" disabled>
        </div>
    </div>
</div>
