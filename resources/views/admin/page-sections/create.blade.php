@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.pages.sections.store', $page) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.page-sections._form')
    </form>
@endsection
