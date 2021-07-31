@extends('layouts.master')

@section('content')
    @component('components.breadcrumbs')
        @slot('active'){{$category->title}}@endslot
    @endcomponent

    <div class="container">
        <div class="row">
            <category></category>
        </div>
    </div>
@endsection
