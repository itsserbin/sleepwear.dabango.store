
<div class="form-group my-3">
    <label for="sizes" class="w-100">Выберите размеры</label>
    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <input type="checkbox" class="btn-check" name="s" id="xs" autocomplete="off" value="1"
               @if($product->xs) checked @endif>
        <label class="btn btn-outline-primary" for="xs">XS</label>

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

        <input type="checkbox" class="btn-check" name="xxxl" id="xxxl" autocomplete="off" value="1"
               @if($product->xxxl) checked @endif>
        <label class="btn btn-outline-primary" for="xxxl">XXXL</label>
    </div>
</div>
