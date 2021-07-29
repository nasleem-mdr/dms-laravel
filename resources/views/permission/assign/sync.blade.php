@extends('layouts.back')

@push('script_select2')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
  $('.select2').select2(
    {
      placeholder: "  Pilih Permissions"
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
  <div class="card-header text-white" style="background-color: #005ea3;">Assign Permission</div>
  <div class="card-body">
    <form action="{{ route('assign.edit', $role)  }}" method="post">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control">
          <option selected disabled">Pilih Role</option>
          @foreach ($roles as $item)
          <option {{ $role->id === $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
          @error('role')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </select>
      </div>

      <div class="form-group">
        <label for="permissions">Permission</label>
        <select name="permissions[]" id="permissions" class="form-control select2" multiple>
          @foreach ($permissions as $permission)
          <option {{ $role->permissions()->find($permission->id) ? 'selected' : '' }} value="{{ $permission->id }}">
            {{ $permission->name}} |
            Guard : {{ $permission->guard_name }}
          </option>
          @endforeach
          @error('permissions')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Sync</button>

    </form>
  </div>

</div>


@endsection