@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.collections.update', $collection) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.collections._form')
    </form>
@endsection
