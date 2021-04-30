<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" id="status" name="status">
        <option value="Новый" @if ($client->status == 'Новый') selected="" @endif>Новый</option>
        <option value="Раннее закупался" @if ($client->status == 'Раннее закупался') selected="" @endif>Раннее закупался</option>
        <option value="ТОПчик" @if ($client->status == 'ТОПчик') selected="" @endif>ТОПчик</option>
        <option value="ЧС" @if ($client->status == 'ЧС') selected="" @endif>ЧС</option>
    </select>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{$client->name}}" disabled>
        </div>

        <div class="form-group my-3">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone"
                   value="{{$client->phone}}" disabled>
            <a href="tel:{{$client->phone}}">Позвонить</a>
        </div>

        <div class="form-group my-3">
            <label for="size">Город</label>
            <input type="text" class="form-control" id="size" name="size"
                   value="{{$client->city ?? "-"}}">
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="size">Комментарии</label>
            <textarea type="text" rows="9" class="form-control" id="comment"
                      name="comment">{{$client->comment}}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="table-responsive">
        <table class="table text-center align-center">
            <thead>
            <tr>
                <th scope="col">Кол-во покупок</th>
                <th scope="col">Общий чек</th>
                <th scope="col">Средний чек</th>
            </thead>
            <tbody>
            <tr>
                <td>{{$client->number_of_purchases}}</td>
                <td>{{$client->whole_check}}</td>
                <td>{{$client->average_check}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="form-group my-3">
                <label for="size">Дата создания</label>
                <input type="text" class="form-control" id="size" name="size"
                       value="{{$client->created_at}}" disabled>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group my-3">
                <label for="size">Дата обновления</label>
                <input type="text" class="form-control" id="size" name="size"
                       value="{{$client->updated_at}}" disabled>
            </div>
        </div>
    </div>
</div>
