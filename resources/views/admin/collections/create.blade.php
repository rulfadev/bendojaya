@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.collections._form')
    </form>
@endsection
