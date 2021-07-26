@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card">
  <div class="card-header">Data Table Employees</div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Kontak</th>
        <th>Instansi</th>
        <th>Jabatan</th>
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
        <td>
          <a class="text-primary" href="{{ route('employee.edit', $employee) }}">Edit</a>
          @include('employee.delete', ['employee'
          => $employee])</td>
      </tr>
      @endforeach

    </table>
  </div>
</div>
@endsection