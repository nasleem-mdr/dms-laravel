@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header">Detail {{ $agency->name }}</div>
  <div class="card-body">

    <div class="form-group">
      <label for="name">Nama Instansi</label>
      <input class="form-control" type="text" value="{{ $agency->name }}" disabled>
    </div>

    <div class="form-group">
      <label for="name">Alamat Instansi</label>
      <input class="form-control" type="text" value="{{ $agency->address }}" disabled>
    </div>

    <div class="form-group mb-3">
      <label for="name">Kontak Instansi</label>
      <input class="form-control" type="text" value="{{ $agency->contact }}" disabled>
    </div>

    <div class="mt-5">
      <h5>List Positions {{ $agency->name }}</h5>
    </div>

    <table class="table table-hover mt-0">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Action</th>
      </tr>

      @foreach ($agency->positions as $index => $position)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $position->name }}</td>
        <td>
          <a class="btn btn-primary " href="{{ route('position.detail', $position) }}">Detail</a>
          <a class="btn btn-primary " href="{{ route('position.edit', $position) }}">Edit</a>
          @include('position.delete', ['position'
          => $position])</td>
      </tr>
      @endforeach

    </table>
    <button type="submit" class="btn btn-primary">Create New Position</button>
  </div>
</div>
@endsection