<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group my-3">
            <label for="name">Название товара</label>
            <input type="text" class="form-control" id="h1" name="h1" placeholder="H1"
                   value="{{$product->h1 ?? ""}}">
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group  my-3">
            <label for="status">Статус публикации</label>
            <select class="form-control" id="published" name="published">
                @if (isset($product->id))
                    <option value="0" @if ($product->published == 0) selected="" @endif>Не опубликовано</option>
                    <option value="1" @if ($product->published == 1) selected="" @endif>Опубликовано</option>
                @else
                    <option value="0">Не опубликовано</option>
                    <option value="1">Опубликовано</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group  my-3">
            <label for="status">Наличие товара</label>
            <select class="form-control" id="status" name="status">
                @if (isset($product->id))
                    <option value="В наличии" @if ($product->status == 'В наличии') selected="" @endif>В наличии
                    </option>
                    <option value="Заканчивается" @if ($product->status == 'Заканчивается') selected="" @endif>
                        Заканчивается
                    </option>
                    <option value="Нет в наличии" @if ($product->status == 'Нет в наличии') selected="" @endif>Нет в
                        наличии
                    </option>
                @else
                    <option value="В наличии">В наличии</option>
                    <option value="Заканчивается">Заканчивается</option>
                    <option value="Нет в наличии">Нет в наличии</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-12 col-md-6">
        @include('admin.product.partials.product-sizes')
    </div>

    <div class="col-12 col-md-6">
        @include('admin.product.partials.product-colors')
    </div>
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
    <div class="col-12 col-md-3 ">
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Цена услуги"
                   value="{{$product->price ?? ""}}" required>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="discount_price">Цена со скидкой</label>
            <input type="text" class="form-control" id="discount_price" name="discount_price"
                   placeholder="Цена услуги со скидкой"
                   value="{{$product->discount_price ?? ""}}">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="trade_price">Закупочная цена</label>
            <input type="text" class="form-control" id="trade_price" name="trade_price" placeholder="Закупочная цена"
                   value="{{$product->trade_price ?? ""}}">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="vendor_code">Артикул</label>
            <input type="text" class="form-control" id="vendor_code" name="vendor_code" placeholder="Артикул"
                   value="{{$product->vendor_code ?? ""}}">
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
</div>
