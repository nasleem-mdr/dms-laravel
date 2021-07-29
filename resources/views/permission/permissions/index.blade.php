@extends('layouts.back')

@section('content')
<div class="card mb-4">
  <div class="card-header text-white" style="background-color: #005ea3;">Create Permission</div>
  <div class="card-body">
    <form action="{{ route('permissions.create') }}" method="POST">
      @csrf
      @include('permission.permissions.partials.form-control', ['submit' => 'Create'])
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Table of Permission</div>
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Guard Name</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
      @foreach ($permissions as $index => $permission)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td> {{ $permission->name }} </td>
        <td>{{ $permission->guard_name }} </td>
        <td>{{ $permission->created_at->format('d-m-Y') }}</td>
        <td class="row">
          <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-info btn-sm">Edit</a>
          <form action="{{ route('permissions.delete', $permission) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm ml-2">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>

  </div>
</div>
@endsection