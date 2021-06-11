@extends('layouts.back')

@section('content')
<div class="card mb-4">
  <div class="card-header">Create Role</div>
  <div class="card-body">
    <form action="{{ route('roles.create') }}" method="POST">
      @csrf
      @include('permission.roles.partials.form-control', ['submit' => 'Create'])
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">Table of Role</div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Guard Name</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
      @foreach ($roles as $index => $role)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td> {{ $role->name }} </td>
        <td>{{ $role->guard_name }} </td>
        <td>{{ $role->created_at->format('d-m-Y') }}</td>
        <td class="row">
          <a href="{{ route('roles.edit', $role) }}" class="btn btn-info btn-sm">Edit</a>
          <form action="{{ route('roles.delete', $role) }}" method="POST">
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