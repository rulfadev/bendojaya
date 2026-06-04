@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.quotations.store') }}" method="POST">
        @csrf
        @include('admin.quotations._form')
    </form>
@endsection
