<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" id="status" name="status">
        @if (isset($product->id))
        <option value="0" @if ($product->status == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($product->status == 1) selected="" @endif>Опубликовано</option>
        @else
            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>
        @endif
    </select>
</div>

<div class="form-group my-3">
    <label for="name">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
           value="{{$product->title ?? ""}}" required>
</div>

<div class="form-group my-3">
    <label for="name">Description</label>
    <textarea type="text" class="form-control" id="description" name="description"
              placeholder="Description">{{$product->description ?? ""}}</textarea>
</div>

<div class="form-group my-3">
    <label for="name">H1</label>
    <input type="text" class="form-control" id="h1" name="h1" placeholder="H1"
           value="{{$product->h1 ?? ""}}">
</div>

<div class="form-group my-3">
    <label for="content">Описание товара</label>
    <textarea type="text" class="form-control" id="content" name="content"
              placeholder="Описание">{{$product->content ?? ""}}</textarea>
</div>
<script>
    CKEDITOR.replace('content');
</script>

<div class="form-group my-3">
    <label for="description">Характеристики товара</label>
    <textarea type="text" class="form-control" id="characteristics" name="characteristics"
              placeholder="Характеристики">{{$product->characteristics ?? ""}}</textarea>
</div>
<script>
    CKEDITOR.replace('characteristics');
</script>

<div class="row my-3">
    <div class="col-12 col-md-6 ">
        <div class="form-group">
            <label for="cost">Цена</label>
            <input type="text" class="form-control" id="cost" name="cost" placeholder="Цена услуги"
                   value="{{$product->cost ?? ""}}" required>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="sale_cost">Цена со скидкой</label>
            <input type="text" class="form-control" id="sale_cost" name="sale_cost" placeholder="Цена услуги"
                   value="{{$product->sale_cost ?? ""}}" required>
        </div>
    </div>
</div>

<div class="form-group my-3">
    <label for="image ">Главное изображение</label>
    <input type="file" class="form-control" id="preview" name="preview" class="form-control">
    @isset($product->preview)
        <picture>
            <source srcset="{{asset($product->preview)}}" type="image/svg+xml">
            <img src="{{asset($product->preview)}}" class="img-thumbnail w-25">
        </picture>
    @endisset
</div>

<div class="form-group my-3">
    <label for="images">Галлерея изображений</label>
    <input type="file" id="images" class="form-control mb-3" name="images[]" multiple>
    <div class="row">
        @isset($productPhoto)
            @foreach($productPhoto as $photo)
                <div class="col-3">
                    <picture>
                        <source srcset="{{asset($photo->image)}}" type="image/svg+xml">
                        <img src="{{asset($photo->image)}}" class="img-thumbnail my-3">
                    </picture>
                </div>
            @endforeach
        @endisset
    </div>
</div>
