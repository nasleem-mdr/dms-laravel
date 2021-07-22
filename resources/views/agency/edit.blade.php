@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header">Create New Agency</div>
  <div class="card-body">
    <form action="{{ route('agency.edit', $agency) }}" method="POST">
      @csrf
      @method('PUT')
      @include('agency.partials.form-control')

    </form>
  </div>
</div>
@endsection