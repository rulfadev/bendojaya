@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.partners._form')
    </form>
@endsection
