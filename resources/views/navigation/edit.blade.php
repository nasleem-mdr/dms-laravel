@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Create New Navigation</div>
  <div class="card-body">
    <form action="{{ route('navigation.edit', $navigation) }}" method="POST">
      @csrf
      @method('PUT')
      @include('navigation.partials.form-control')
    </form>

  </div>
</div>


@endsection