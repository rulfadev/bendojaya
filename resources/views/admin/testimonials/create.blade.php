@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.testimonials._form')
    </form>
@endsection
