@if(count($colors))
    <div class="form-group my-3">
        <label for="colors" class="w-100">Выберите доступные цвета</label>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <div class="row">
                <div class="col-12">
                    @foreach($colors as $color)
                        <style>
                            .{{$color->name}}    {
                                background-color: none;
                            }

                            .{{$color->name}}:checked + .btn-outline-primary {
                                background-color: {{$color->hex}};
                            }
                        </style>
                        <input type="checkbox" class="btn-check {{$color->name}}" name="colors[]" id="{{$color->name}}"
                               autocomplete="off"
                               value="{{$color->id}}"
                               @if(isset($ProductsColor))
                               @foreach($ProductsColor as $ProductColor)
                               @if($color->id == $ProductColor->color_id) checked @endif
                            @endforeach
                            @endif
                        >
                        <label class="btn btn-outline-primary my-1"
                               style="color: {{$color->hex}}; border-color: {{$color->hex}}"
                               onmouseover="this.style.backgroundColor='{{$color->hex}}';"
                               onmouseout="this.style.backgroundColor='';"
                               for="{{$color->name}}">{{$color->name}}</label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
