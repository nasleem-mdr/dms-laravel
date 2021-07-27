@extends('layouts.back')


@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@section('content')
<div class="card">
  <div class="card-header">Tambahkan Arsip Dokumen </div>
  <div class="card-body">
    <form action="{{ route('document.create') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @include('document.partials.form-control')
    </form>
  </div>
</div>
@endsection