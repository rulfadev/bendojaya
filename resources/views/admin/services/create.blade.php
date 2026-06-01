@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.services._form')
    </form>
@endsection
