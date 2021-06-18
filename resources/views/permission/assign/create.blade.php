@extends('layouts.back')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
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

<div class="card">
  <div class="card-header">Assign Permission</div>
  <div class="card-body">
    <form action="{{ route('assign.create')  }}" method="post">
      @csrf
      <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control">
          <option selected disabled">Pilih Role</option>
          @foreach ($roles as $role)
          <option value="{{ $role->id }}">{{ $role->name }}</option>
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
          <option value="{{ $permission->id }}">{{ $permission->name }}</option>
          @endforeach
          @error('permissions')
          <div class="text-danger mt-2 d-block">{{ $message }}</div>
          @enderror
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Assign</button>

    </form>
  </div>

</div>
@endsection