@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.users.update', $userData) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.users._form')
    </form>
@endsection
