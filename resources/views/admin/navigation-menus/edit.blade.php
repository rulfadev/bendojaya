@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.navigation-menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.navigation-menus._form')
    </form>
@endsection
