@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.quotations.update', $quotation) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.quotations._form')
    </form>
@endsection
