@extends('layouts.master')

@section('content')
    @component('components.breadcrumbs')
        @slot('active')Оформление заказа@endslot
    @endcomponent

    <div class="content">
        <div class="row">
            <div class="col-12">
                <checkout></checkout>
            </div>
        </div>
    </div>

@endsection
