@extends('layouts.back')

@section('content')
<div class="card mb-4">
  <div class="card-header text-white" style="background-color: #005ea3;">Edit Role</div>
  <div class="card-body">
    <form action="{{ route('roles.edit', $role)  }}" method="POST">
      @csrf
      @method('PUT')
      @include('permission.roles.partials.form-control')
    </form>
  </div>
</div>

@endsection