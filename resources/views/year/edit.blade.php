@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card mb-3">
  <div class="card-header">Edit {{ $year->year }}</div>
  <div class="card-body">
    <form action="{{ route('year.edit', $year)  }}" method="post">
      @csrf
      @method('PUT')
      @include('year.partials.form-control')
    </form>
  </div>

</div>

@endsection