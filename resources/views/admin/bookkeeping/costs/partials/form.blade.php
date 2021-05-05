<div class="form-group my-3">
    <label for="name">Название</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Название траты"
           value="{{$cost->name ?? ""}}" required>
</div>

<div class="form-group my-3">
    <label for="quantity">Количество</label>
    <input type="text" class="form-control" id="quantity" name="quantity"
           placeholder="Введите количество" value="{{$cost->quantity ?? ""}}" required>
</div>

<div class="form-group my-3">
    <label for="sum">Сумма</label>
    <input type="text" class="form-control" id="sum" name="sum"
           placeholder="Введите сумму" value="{{$cost->sum ?? ""}}" required>
</div>

<div class="form-group my-3">
    <label for="comment">Комментарий</label>
    <textarea type="text" class="form-control" id="comment" name="comment" rows="5"
              placeholder="Введите комментарий">{{$cost->comment ?? ""}}</textarea>
</div>

@if(isset($cost->user_id))
    <fieldset disabled>
        <div class="mb-3">
            <label for="disabledTextInput" class="form-label">Ответственный</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$cost->user->name}}">
        </div>
    </fieldset>
@endif

<div class="form-group my-3">
    <label for="date">Дата</label>
    <input type="date" class="form-control datepicker-here" data-timepicker="true"
           data-time-format='hh:mm' id="date" name="date"
           value="{{$cost->date}}" placeholder="Введите дату расхода">
</div>
