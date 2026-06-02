@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.partners._form')
    </form>
@endsection
