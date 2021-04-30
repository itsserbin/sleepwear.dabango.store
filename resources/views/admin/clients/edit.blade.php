@extends('layouts.app')
@section('title','Карточка клиента')
@section('header','Карточка клиента')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.clients.update', $client->id)}}" method="post"
                      enctype="multipart/form-data"
                      multiple>
                    @csrf
                    @method('PATCH')
                    {{-- Form include --}}
                    @include('admin.clients.partials.form')
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
