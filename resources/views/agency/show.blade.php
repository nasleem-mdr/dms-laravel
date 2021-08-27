@extends('layouts.back')

@section('content')
<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">Detail {{ $agency->name }}</div>
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
      <h5>List Jabatan di {{ $agency->name }}</h5>
    </div>

    <table class="table table-hover mt-0">
      <tr>
        <th>#</th>
        <th>Jabatan</th>
        <th>Aksi</th>
      </tr>

      @foreach ($agency->positions as $index => $position)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $position->position }}</td>
        <td>
          <!--<a class="btn btn-primary " href="{{ route('position.detail',[$agency, $position]) }}">Detail</a>-->
          <a class="btn btn-primary " href="{{ route('position.edit', [$agency, $position]) }}">Edit</a>
          @include('agency.position.delete', ['position'
          => $position])</td>
      </tr>
      @endforeach

    </table>
    <a href="{{ route('position.create', $agency) }}" type="submit" class="btn btn-primary">Buat Posisi Baru</a>

    <div class="mt-5">
      <h5>List Pegawai di {{ $agency->name }}</h5>
    </div>

    <table class="table table-hover mt-0">
      <tr>
        <th>#</th>
        <th>Jabatan</th>
        <th>NIP</th>
        <th>Nama</th>
      </tr>

      @foreach ($agency->employees as $index => $employee)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $employee->position->position }}</td>
        <td>{{ $employee->nip }}</td>
        <td>{{ $employee->name }}</td>
      </tr>
      @endforeach

    </table>

  </div>
</div>


@endsection