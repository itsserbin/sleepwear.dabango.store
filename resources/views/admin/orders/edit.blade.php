@extends('layouts.app')
@section('title','Детали заказа')
@section('header','Детали заказа')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.orders.update', $order->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- Form include --}}
                    @include('admin.orders.partials.form')
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
