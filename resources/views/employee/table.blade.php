@extends('layouts.back')

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

<div class="card">
  <div class="card-header text-white" style="background-color: #005ea3;">
    <div class="col justify-content-md-around">
      Data Pegawai @if ($user->hasRole(['admin', 'pegawai']))
      {{ $user->employee->agency->name }}
      @endif
      <a class="btn btn-sm btn-primary float-right" href="{{ route('employee.create') }}">Tambah Pegawai Baru</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="employeeTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th data-field="nip">NIP</th>
            <th data-field="nama">Nama</th>
            <th data-field="alamat">Alamat</th>
            <th data-field="kontak">Kontak</th>
            @if ($user->hasRole('super admin'))
            <th data-field="instansi">Instansi</th>
            @endif
            <th data-field="jabatan">Jabatan</th>
            <th data-sortable="falase">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($employees as $index => $employee)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $employee->nip}}</td>
            <td>{{ $employee->name }}</td>
            <td class="{{ ($employee->address === null) ? 'text-center' : ''}}">
              {{ ($employee->address === null) ? '-' : $employee->address }}
            </td>
            <td class="{{ ($employee->phone_number === null) ? 'text-center' : ''}}">
              {{ ($employee->phone_number === null) ? '-' : $employee->phone_number }}
            </td>
            @if ($user->hasRole('super admin'))
            <td>{{ $employee->agency->name }}</td>
            @endif
            <td>{{ $employee->position->position ?? '-' }}</td>

            <td>
              <a class=" text-primary" href="{{ route('employee.edit', $employee) }}">Edit</a>
              @include('employee.delete', ['employee' => $employee])
              @if ($user->hasRole('super admin'))

              @include('employee.reset', ['employee' => $employee])

              @endif

            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection