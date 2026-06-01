@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.pages._form')
    </form>
@endsection
