<div class="row mt-5">
    <h3 class="text-end"><b>Перед удалением изображений - сохраните отредактированные
            данные ;)</b></h3>
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
