@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Edit Position {{ $position->position }} at {{ $agency->name }}</div>
  <div class="card-body">
    <form action="{{ route('position.edit', [$agency, $position]) }}" method="POST">
      @csrf
      @method('PUT')
      @include('agency.position.partials.form-control')
    </form>
  </div>
</div>
@endsection