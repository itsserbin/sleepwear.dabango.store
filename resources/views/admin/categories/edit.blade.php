@extends('layouts.app')

@section('content')
    <category-edit user-name="{{\Illuminate\Support\Facades\Auth::user()->name}}"></category-edit>
@endsection
