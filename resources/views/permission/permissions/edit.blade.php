@extends('layouts.back')

@section('content')
<div class="card mb-4">
  <div class="card-header text-white" style="background-color: #005ea3;">Edit Permission</div>
  <div class="card-body">
    <form action="{{ route('permissions.edit', $permission)  }}" method="POST">
      @csrf
      @method('PUT')
      @include('permission.permissions.partials.form-control')
    </form>
  </div>
</div>

@endsection