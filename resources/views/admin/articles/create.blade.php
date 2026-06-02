@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.articles._form')
    </form>
@endsection
