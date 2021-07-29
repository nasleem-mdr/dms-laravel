@extends('layouts.back')


@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Edit {{ $archive->no }}</div>
  <div class="card-body">
    <form action="{{ route('archive.edit', $archive) }}" method="POST">
      @csrf
      @method('PUT')
      @include('archive.partials.form-control')
    </form>
  </div>
</div>
@endsection