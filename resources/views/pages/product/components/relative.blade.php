<section class="relative">
    <div class="container">
        <div class="row">
            <h2>Смотрите так же</h2>
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card m-3">
                        <img src="{{asset($product->preview)}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$product->h1}}</h5>
                            <a href="{{route('product', $product->id)}}" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
