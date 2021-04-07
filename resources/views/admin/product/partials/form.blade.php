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
    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <input type="checkbox" class="btn-check" name="s" id="s" autocomplete="off" value="1"
               @if($product->s) checked @endif>
        <label class="btn btn-outline-primary" for="s">S</label>

        <input type="checkbox" class="btn-check" name="m" id="m" autocomplete="off" value="1"
               @if($product->m) checked @endif>
        <label class="btn btn-outline-primary" for="m">M</label>

        <input type="checkbox" class="btn-check" name="l" id="l" autocomplete="off" value="1"
               @if($product->l) checked @endif>
        <label class="btn btn-outline-primary" for="l">L</label>

        <input type="checkbox" class="btn-check" name="xl" id="xl" autocomplete="off" value="1"
               @if($product->xl) checked @endif>
        <label class="btn btn-outline-primary" for="xl">XL</label>

        <input type="checkbox" class="btn-check" name="xxl" id="xxl" autocomplete="off" value="1"
               @if($product->xxl) checked @endif>
        <label class="btn btn-outline-primary" for="xxl">XXL</label>
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
                   value="{{$product->sale_cost ?? ""}}">
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
    <h3 class="text-end"><b>Перед удалением изображений - сохраните отредактированные данные ;)</b></h3>
    <div class="row">
        @isset($productPhoto)
            @foreach($productPhoto as $photo)
                <div class="col-12 col-sm-3 col-md-4">
                    <picture>
                        <source srcset="{{asset($photo->image)}}" type="image/svg+xml">
                        <img src="{{asset($photo->image)}}" class="img-thumbnail my-3">
                    </picture>
                    <form action="{{route('destroy.image')}}" method="POST" class="text-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$photo->id}}">
                        <button type="submit" class="btn">
                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                 class="bi bi-trash-fill"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        @endisset
    </div>
</div>
