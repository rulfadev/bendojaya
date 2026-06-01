@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.pages.sections.update', [$page, $section]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.page-sections._form')
    </form>
@endsection
