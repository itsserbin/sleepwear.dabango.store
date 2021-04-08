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
    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <div class="row">
            <h3>Актиные цвета</h3>
            <div class="col-12">
                @foreach($ProductsColor as $item)
                    <input type="checkbox" class="btn-check" name="color[]" id="{{$item->color}}" autocomplete="off"
                           value="{{$item->color}}"
                           @if($item->color) checked @endif>
                    <label class="btn btn-outline-primary" for="{{$item->color}}">{!! $item->color !!}</label>
                @endforeach
            </div>

        </div>
        <div class="row">
            <h3>Все цвета:</h3>
            <div class="col-12">

                <input type="checkbox" class="btn-check" name="color[]" id="white" autocomplete="off" value="Белый">
                <label class="btn btn-outline-primary" for="white">Белый</label>

                <input type="checkbox" class="btn-check" name="color[]" id="gray" autocomplete="off" value="Серый">
                <label class="btn btn-outline-primary" for="gray">Серый</label>

                <input type="checkbox" class="btn-check" name="color[]" id="red" autocomplete="off" value="Красный">
                <label class="btn btn-outline-primary" for="red">Красный</label>

                <input type="checkbox" class="btn-check" name="color[]" id="burgundy" autocomplete="off"
                       value="Бордовый">
                <label class="btn btn-outline-primary" for="burgundy">Бордовый</label>

                <input type="checkbox" class="btn-check" name="color[]" id="blue" autocomplete="off" value="Синий">
                <label class="btn btn-outline-primary" for="blue">Синий</label>

                <input type="checkbox" class="btn-check" name="color[]" id="green" autocomplete="off" value="Зеленый">
                <label class="btn btn-outline-primary" for="green">Зеленый</label>

                <input type="checkbox" class="btn-check" name="color[]" id="turquoise" autocomplete="off"
                       value="Бирюзовый">
                <label class="btn btn-outline-primary" for="turquoise">Бирюзовый</label>

                <input type="checkbox" class="btn-check" name="color[]" id="yellow" autocomplete="off" value="Желтый">
                <label class="btn btn-outline-primary" for="yellow">Желтый</label>
            </div>
        </div>

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
</div>
