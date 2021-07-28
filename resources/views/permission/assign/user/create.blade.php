@extends('layouts.back')

@push('script_select2')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
  $('.select2').select2(
    {
      placeholder: "  Pilih Roles"
    }
  );
  });
</script>
@endpush

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card mb-3">
  <div class="card-header">Pick Roles for User</div>

  <div class="card-body">
    <div class="table-responsive">
      <form action="{{ route('assign.user.create')  }}" method="post">
        @csrf
        <div class="form-group">
          <label for="user">User</label>
          <input type="text" name="email" id="user" class="form-control">
        </div>

        <div class="form-group">
          <label for="roles">Role</label>
          <select name="roles[]" id="roles" class="form-control select2" multiple>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
            @error('role')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign</button>

      </form>
    </div>

  </div>

  <div class="card">
    <div class="card-header">
      Table User and Roles
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Action</th>
          </tr>
          @foreach ($users as $index => $user)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
            <td><a href="{{ route('assign.user.edit', $user) }}">Sync</a></td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    @endsection