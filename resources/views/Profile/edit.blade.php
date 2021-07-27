@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@section('content')
<div class="card">
  <div class="card-header">Edit Profile</div>
  <div class="card-body">
    <form action="{{ route('profile.edit', $employee) }}" method="POST">
      @csrf
      @method('PUT')
      @include('profile.partials.form-control')
    </form>
  </div>
</div>
@endsection