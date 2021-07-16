@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header">Create New Navigation</div>
  <div class="card-body">
    <form action="{{ route('navigation.create') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="parent_id">Parent</label>
        <select name="parent_id" id="parent_id" class="form-control">
          <option selected disabled>Choose a parent</option>
          @foreach ($navigations as $navigation)
          <option value="{{ $navigation->id }}">{{ $navigation->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="permission_name">Permission</label>
        <select name="permission_name" id="permission_name" class="form-control">
          <option selected disabled>Choose a permission</option>
          @foreach ($permissions as $permission)
          <option value="{{ $permission->name }}">{{ $permission->name }}</option>
          @endforeach
        </select>
        @error('permission_name')
        <div class="text-danger mt-2 d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Create new post">
            @error('permission_name')
            <div class="text-danger mt-1 d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" id="url" class="form-control" placeholder="posts/create">
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-info">Create</button>
    </form>
  </div>
</div>
@endsection