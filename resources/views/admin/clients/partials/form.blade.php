<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" id="status" name="status">
        <option value="new" @if ($client->status == 'new') selected="" @endif>Новый</option>
        <option value="process" @if ($client->status == 'process') selected="" @endif>В процессе</option>
        <option value="done" @if ($client->status == 'done') selected="" @endif>Выполнен</option>
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
            <label for="size">Размер</label>
            <input type="text" class="form-control" id="size" name="size"
                   value="{{$client->size}}" disabled>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group my-3">
            <label for="size">Комментарии</label>
            <textarea type="text" rows="9" class="form-control" id="comment" name="comment">{{$client->comment}}</textarea>
        </div>
    </div>
</div>


{{--<div class="form-group my-3">--}}
{{--    <label for="name">Description</label>--}}
{{--    <textarea type="text" class="form-control" id="description" name="description"--}}
{{--              placeholder="Description">{{$product->description ?? ""}}</textarea>--}}
{{--</div>--}}

{{--<div class="form-group my-3">--}}
{{--    <label for="name">H1</label>--}}
{{--    <input type="text" class="form-control" id="h1" name="h1" placeholder="H1"--}}
{{--           value="{{$product->h1 ?? ""}}">--}}
{{--</div>--}}

{{--<div class="form-group my-3">--}}
{{--    <label for="content">Описание товара</label>--}}
{{--    <textarea type="text" class="form-control" id="content" name="content"--}}
{{--              placeholder="Описание">{{$product->content ?? ""}}</textarea>--}}
{{--</div>--}}
{{--<script>--}}
{{--    CKEDITOR.replace('content');--}}
{{--</script>--}}

{{--<div class="form-group my-3">--}}
{{--    <label for="description">Характеристики товара</label>--}}
{{--    <textarea type="text" class="form-control" id="characteristics" name="characteristics"--}}
{{--              placeholder="Характеристики">{{$product->characteristics ?? ""}}</textarea>--}}
{{--</div>--}}
{{--<script>--}}
{{--    CKEDITOR.replace('characteristics');--}}
{{--</script>--}}

{{--<div class="row my-3">--}}
{{--    <div class="col-12 col-md-6 ">--}}
{{--        <div class="form-group">--}}
{{--            <label for="cost">Цена</label>--}}
{{--            <input type="text" class="form-control" id="cost" name="cost" placeholder="Цена услуги"--}}
{{--                   value="{{$product->cost ?? ""}}" required>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-12 col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label for="sale_cost">Цена со скидкой</label>--}}
{{--            <input type="text" class="form-control" id="sale_cost" name="sale_cost" placeholder="Цена услуги"--}}
{{--                   value="{{$product->sale_cost ?? ""}}" required>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group my-3">--}}
{{--    <label for="image ">Главное изображение</label>--}}
{{--    <input type="file" class="form-control" id="preview" name="preview" class="form-control">--}}
{{--    @isset($product->preview)--}}
{{--        <picture>--}}
{{--            <source srcset="{{asset($product->preview)}}" type="image/svg+xml">--}}
{{--            <img src="{{asset($product->preview)}}" class="img-thumbnail w-25">--}}
{{--        </picture>--}}
{{--    @endisset--}}
{{--</div>--}}

{{--<div class="form-group my-3">--}}
{{--    <label for="images">Галлерея изображений</label>--}}
{{--    <input type="file" id="images" class="form-control mb-3" name="images[]" multiple>--}}
{{--    @isset($productPhoto)--}}
{{--        @foreach($productPhoto as $photo)--}}
{{--            <picture>--}}
{{--                <source srcset="{{asset($photo->image)}}" type="image/svg+xml">--}}
{{--                <img src="{{asset($photo->image)}}" class="img-thumbnail w-25">--}}
{{--            </picture>--}}
{{--        @endforeach--}}
{{--    @endisset--}}
{{--</div>--}}
