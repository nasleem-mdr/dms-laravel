@extends('layouts.back')

@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if (session('error_message'))
<div class="alert alert-danger">
  {{ session('success') }}
</div>
@endif

<div class="card">
  <div class="card-header">
    <div class="col justify-content-md-around">
      <div>
        My Profile
      </div>
    </div>
  </div>

  <div class="card-body">

    <table class="table table-hover">
      <tr>
        <td>NIP</td>
        <td>{{ $employee->nip}}</td>
      </tr>
      <tr>
        <td>Email</td>
        <td>{{ $employee->user->email}}</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>{{ $employee->name }}</td>
      </tr>

      <tr>
        <td>Instansi</td>
        <td>{{ $employee->agency->name }}</td>
      </tr>

      <tr>
        <td>Jabatan</td>
        <td>{{ $employee->position->position }}</td>
      </tr>

      <tr>
        <td>Alamat</td>
        <td>{{ $employee->address }}</td>
      </tr>

      <tr>
        <td>Kontak</td>
        <td>{{ $employee->phone_number }}</td>
      </tr>

    </table>
  </div>
</div>

@endsection