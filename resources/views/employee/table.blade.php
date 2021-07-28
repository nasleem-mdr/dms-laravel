@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card">
  <div class="card-header">
    <div class="col justify-content-md-around">
      Data Table Employees
      <a class="btn btn-sm btn-primary float-right" href="{{ route('employee.create') }}">Add New Employee</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Kontak</th>
        <th>Instansi</th>
        <th>Jabatan</th>
        @if ($user->hasRole('super admin'))
        <th>
          Roles
        </th>
        @endif
        <th>Action</th>
      </tr>

      @foreach ($employees as $index => $employee)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $employee->nip}}</td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->address }}</td>
        <td>{{ $employee->phone_number }}</td>
        <td>{{ $employee->agency->name }}</td>
        <td>{{ $employee->position->position }}</td>
        @if ($user->hasRole('super admin'))
        <td>
          {{ implode(', ', $employee->user->getRoleNames()->toArray()) }}
        </td>
        @endif
        <td>
          <a class="text-primary" href="{{ route('employee.edit', $employee) }}">Edit</a>
          @include('employee.delete', ['employee' => $employee])
          @if ($user->hasRole('super admin'))

          @include('employee.reset', ['employee' => $employee])

          @endif

        </td>
      </tr>
      @endforeach

    </table>
  </div>
</div>
@endsection