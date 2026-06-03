@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.faqs._form')
    </form>
@endsection
