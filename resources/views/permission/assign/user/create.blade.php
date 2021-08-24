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
  <div class="card-header text-white" style="background-color: #005ea3;">Pick Roles for User</div>

  <div class="card-body">
    <div class="table-responsive">
      <form action="{{ route('assign.user.create')  }}" method="post">
        @csrf
        <div class="form-group">

          <label for="user" class="form-label">NIP Pegawai</label>
          <input class="form-control" list="datalistNIP" id="user" name="nip"
            placeholder="Masukkan NIP Pegawai/Pilih NIP Pegawai">
          <datalist id="datalistNIP">
            @foreach($users as $user)
            <option value="{{$user->username}}">{{$user->employee->name}}</option>
            @endforeach
          </datalist>

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
</div>

<div class="card mt-2">
  <div class="card-header text-white" style="background-color: #005ea3;">
    Table User and Roles
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover">
        <tr>
          <th>#</th>
          <th>NIP/Username</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Action</th>
        </tr>
        @foreach ($users as $index => $user)
        <tr>
          <td>{{ $index+1 }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
          <td><a href="{{ route('assign.user.edit', $user) }}">Sync</a></td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection