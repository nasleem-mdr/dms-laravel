@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header">Create New Position at {{ $agency->name }}</div>
  <div class="card-body">
    <form action="{{ route('position.create', $agency) }}" method="POST">
      @csrf
      @include('agency.position.partials.form-control')
    </form>
  </div>
</div>
@endsection