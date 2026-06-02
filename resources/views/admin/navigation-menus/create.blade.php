@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.navigation-menus.store') }}" method="POST">
        @csrf
        @include('admin.navigation-menus._form')
    </form>
@endsection
