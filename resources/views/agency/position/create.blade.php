@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Buat Posisi Baru di {{ $agency->name }}</div>
  <div class="card-body">
    <form action="{{ route('position.create', $agency) }}" method="POST">
      @csrf
      @include('agency.position.partials.form-control')
    </form>
  </div>
</div>
@endsection