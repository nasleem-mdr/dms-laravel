@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Create New Agency</div>
  <div class="card-body">
    <form action="{{ route('agency.edit', $agency) }}" method="POST">
      @csrf
      @method('PUT')
      @include('agency.partials.form-control')

    </form>
  </div>
</div>
@endsection