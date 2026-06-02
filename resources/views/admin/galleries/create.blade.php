@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.galleries._form')
    </form>
@endsection
