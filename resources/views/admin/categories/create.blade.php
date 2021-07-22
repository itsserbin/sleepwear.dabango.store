@extends('layouts.app')

@section('content')
    <category-create user-name="{{\Illuminate\Support\Facades\Auth::user()->name}}"></category-create>
@endsection
