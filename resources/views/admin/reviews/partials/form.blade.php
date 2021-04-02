<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" id="status" name="status">
            <option value="0" @if ($review->status == 0) selected="" @endif>На модерации</option>
            <option value="1" @if ($review->status == 1) selected="" @endif>Опубликовано</option>
    </select>
</div>

<div class="form-group my-3">
    <label for="name">Имя</label>
    <input type="text" class="form-control" id="name" name="name"
           value="{{$review->name}}" required>
</div>

<div class="form-group my-3">
    <label for="comment">Отзыв</label>
    <textarea rows="5" type="text" class="form-control" id="comment" name="comment" required>{{$review->comment}}</textarea>
</div>
