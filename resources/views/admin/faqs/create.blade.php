@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        @include('admin.faqs._form')
    </form>
@endsection
