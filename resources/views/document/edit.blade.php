@extends('layouts.back')


@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@section('content')
<div class="card">
  <div class="card-header">Edit {{ $document->no }}</div>
  <div class="card-body">
    <form action="{{ route('document.edit', $document) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('document.partials.form-control')
    </form>
  </div>
</div>
@endsection