@extends('layouts.app')
@section('title', 'Создать товар')
@section('header', 'Создать товар')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('admin.product.partials.form')

                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
