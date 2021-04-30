@extends('layouts.app')
@section('title','Редактирование товара')
@section('header','Редактирование товара')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.products.update', $product->id)}}" method="post"
                      enctype="multipart/form-data"
                      multiple>
                    @csrf
                    @method('PATCH')
                    {{-- Form include --}}
                    @include('admin.product.partials.form')

                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
                {{-- Images --}}
                @include('admin.product.partials.product-images')
            </div>
        </div>
    </div>
@endsection
