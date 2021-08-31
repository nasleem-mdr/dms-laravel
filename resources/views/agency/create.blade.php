@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Buat Unit Baru</div>
  <div class="card-body">
    <form action="{{ route('agency.create') }}" method="POST">
      @csrf
      @include('agency.partials.form-control')
    </form>
  </div>
</div>
@endsection