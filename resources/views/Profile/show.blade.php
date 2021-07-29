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
  <div class="card-header text-white" style="background-color: #005ea3;">
    <div class="col justify-content-md-around">
      <div>
        My Profile
      </div>
    </div>
  </div>

  <div class="card-body d-flex" style="background-color: #0482dc;">

    <div class="row">
      <div class="col-md-4">
        <img style="width: 100%" class="pl-3"
          src="{{ ($user->employee->profile_picture) ? asset($user->employee->profile_picture) : asset('/images/profile/avatar-default.png')  }}"
          alt="{{ ($user->employee->profile_picture) ? $user->employee->profile_picture : 'avatar-default'}}"></div>
      <div class="col">
        <div class="row">
          <table class="table table-hover text-white">
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
        <div class="row d-flex justify-content-sm-between">
          <div class="col"></div>

          <div class="col"><a href="{{ route('profile.reset_password') }}" class="btn btn-info btn-sm">Ubah
              Password</a>
            <a href="{{ route('profile.edit')  }}" class="btn btn-info btn-sm">Ubah Profile</a></div>
        </div>
      </div>


    </div>

  </div>
</div>

@endsection