@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Buat Navigasi Baru</div>
  <div class="card-body">
    <form action="{{ route('navigation.create') }}" method="POST">
      @csrf
      @include('navigation.partials.form-control')
    </form>
  </div>
</div>
@endsection