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
<script>
  function checkRoles(selected){
    let selectedRolesElement = document.getElementById('roles');
    let selectedRoles = selected.options[selected.selectedIndex].text
    let infoElement = document.getElementById('info')
    if(selectedRoles === 'admin' || selectedRoles === 'super admin'){
      infoElement.innerText = "Jika memilih role admin atau super admin, maka user otomatis akan mendapatkan role pegawai"
    }
    
  }
</script>
@endpush

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif

<div class="card mb-3">
  <div class="card-header text-white" style="background-color: #005ea3;">Pilih Roles untuk User</div>

  <div class="card-body">
    <div class="table-responsive">
      <form action="{{ route('assign.user.create')  }}" method="post">
        @csrf
        <div class="form-group">

          <label for="user" class="form-label">NIP Pegawai</label>
          <input class="form-control" list="datalistNIP" id="user" name="nip"
            placeholder="Masukkan NIP Pegawai/Pilih NIP Pegawai">
          @error('nip')
          <div class="text-danger mt-1 d-block">{{ $message }}</div>
          @enderror

          <datalist id="datalistNIP">
            @foreach($users as $user)
            <option value="{{$user->username}}">{{$user->employee->name}}</option>
            @endforeach
          </datalist>

        </div>
        <div class="form-group">
          <label for="roles">Role</label>
          <select onchange="checkRoles(this)" name="roles[]" id="roles" class="form-control select2" multiple>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
          <div id="info" class="text-info mt-2 d-block"></div>
          @error('roles')
          <div class="text-danger mt-1 d-block">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Assign</button>
      </form>
    </div>

  </div>
</div>

<div class="card mt-2">
  <div class="card-header text-white" style="background-color: #005ea3;">
    Tabel User dan Roles
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover">
        <tr>
          <th>#</th>
          <th>NIP/Username</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Aksi</th>
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