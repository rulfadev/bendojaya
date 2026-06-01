@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pages._form')
    </form>
@endsection
